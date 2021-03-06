<?php

    namespace App\Http\Controllers;

    use App\Gebruiker;
    use App\Http\Requests\gebruikerRegistratieRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use Illuminate\Support\Facades\Log;


    class GebruikerController extends Controller
    {
        public function login(Request $request)
        {
            $data = $request->all();

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = Auth::user();
                $rol = \App\Rol::find($user->rol_id)->first();
                $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', $user->id)->first();
                if($rol->naam == "Verantwoordelijke" && $vereniging->actief == 0) {
                    return response()->json(['error' => 'Uw vereniging is nog niet actief'], 444);
                } else {
                    $success['token'] = $user->createToken('MyApp')->accessToken;
                    return response()->json($success);
                }

            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }

        public function registreerVerantwoordelijke(Request $request)
        {
            $data = $request->all();

            if (\App\Gebruiker::where('email', $data['email'])->first() == null) {
                $rol = \App\Rol::find(3);
                if ($data['password'] == null) {
                    $nieuwwachtwoord = substr(md5(microtime()), rand(0, 26), 10);
                    $data['password'] = bcrypt($nieuwwachtwoord);
                    $this->sendMail($data['email'], 'Account Gladiolen Aangemaakt', '<h1>Uw account voor Keizer Karel is
                        aangemaakt!</h1><p>U kan nu inloggen met uw e-mail en het volgende wachtwoord ' . $nieuwwachtwoord . '</p>' .
                        '<p>Vergeet niet om uw wachtwoord te veranderen!</p>');
                } else {
                    $data['password'] = bcrypt($data['password']);
                }
                $gebruiker = \App\Gebruiker::create($data);
                $gebruiker->rol()->associate($rol);

                $gebruiker->save();

                return response()->json($gebruiker);
            } else {
                Throw new \Exception('email');
            }
        }

        public function registreerGebruiker(Request $request)
        {
            $data = $request->all();
            $nieuwwachtwoord = substr(md5(microtime()), rand(0, 26), 10);
            $data['password'] = bcrypt($nieuwwachtwoord);
            $rol = \App\Rol::find($data['rol_id']);
            $gebruiker = \App\Gebruiker::create($data);

            $gebruiker->rol()->associate($rol);

            $gebruiker->save();
            $this->sendMail($gebruiker->email, 'Account Gladiolen Aangemaakt', '<h1>Uw account voor Keizer Karel is
                        aangemaakt!</h1><p>U kan nu inloggen met uw e-mail en het volgende wachtwoord ' . $nieuwwachtwoord . '</p>' .
                '<p>Vergeet niet om uw wachtwoord te veranderen!</p>');
            return response()->json($gebruiker);
        }

        public function index()
        {
            $lids = \App\Gebruiker::with('tshirts','rol')->orderBy('actief', 'desc')->orderBy('voornaam', 'asc')->get();
            return response()->json($lids);
        }


        public function getGebruiker($id)
        {
            $gebruiker = \App\Gebruiker::with('tshirts', 'rol')->find($id);
            return response()->json($gebruiker);
        }

        public function getVrijwilligersByVereniging($verenigingId)
        {
            $vereniging = \App\Vereniging::with('gebruikers', 'gebruikers.rol')->find($verenigingId);
            $vrijwilligers = $vereniging->gebruikers;
            return response()->json($vrijwilligers);
        }

        public function getKernleden()
        {
            $kernleden = \App\Gebruiker::where(['rol_id' => 2])->get();
            return response()->json($kernleden);
        }

        public function getAdmins()
        {
            $admins = \App\Gebruiker::where('rol_id', 1)->get();
            return response()->json($admins);
        }

        public function getLid($id)
        {
            $lid = \App\Gebruiker::with('tshirts')->find($id);
            return response()->json($lid);
        }

        public function addLid(Request $request)
        {
            $data = $request->all();

            if(\App\Gebruiker::where('rijksregisternr', $data['rijksregisternr'])->first() == null) {
                $gebruiker = \App\Gebruiker::create($data);
                $rol = \App\Rol::find(4);

                $gebruiker->rol()->associate($rol);
                $gebruiker->save();
            } else {
                $gebruiker = \App\Gebruiker::where('rijksregisternr', $data['rijksregisternr'])->first();
            }
            $user = Auth::user();
            $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', $user->id)->first();
            $vereniging->gebruikers()->sync([$gebruiker->id],false);

            return response()->json($gebruiker);
        }

        public function addLidAdmin(Request $request, $verenigingId)
        {
            $data = $request->all();

            if(\App\Gebruiker::where('rijksregisternr', $data['rijksregisternr'])->first() == null) {
                $gebruiker = \App\Gebruiker::create($data);
                $rol = \App\Rol::find(4);

                $gebruiker->rol()->associate($rol);
                $gebruiker->save();
            } else {
                $gebruiker = \App\Gebruiker::where('rijksregisternr', $data['rijksregisternr'])->first();
            }

            $vereniging = \App\Vereniging::where('id', $verenigingId)->first();
            $vereniging->gebruikers()->sync([$gebruiker->id],false);

            return response()->json($gebruiker);
        }

        public function deleteLid($id)
        {
            $user = Auth::user();
            $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', $user->id)->first();
            $vereniging->gebruikers()->detach($id);
//            $lid = \App\Gebruiker::find($id);
//            $lid->delete();
        }

        public function deleteLidAdmin($verenigingId, $userId)
        {
            $vereniging = \App\Vereniging::where('id', $verenigingId)->first();
            $vereniging->gebruikers()->detach($userId);
        }

        public function updateLid($id, Request $request)
        {
            $data = $request->all();
            $gebruiker = \App\Gebruiker::find($id)->update($data);

            return response()->json($gebruiker);
        }

        public function detailIngelogdeGebruiker()
        {
            $user = Auth::user();
            return response()->json($user);
        }

        public function updateIngelogdeGebruiker(Request $request)
        {
            $data = $request->all();
            if ($data['password'] == null) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
                $data['eersteAanmelding'] = 0;
            }
            $user = Auth::user();

            $updatedUser = \App\Gebruiker::find($user->id)->update($data);

            return response()->json($updatedUser);
        }

        public function resetPassword(Request $request)
        {
            $data = $request->all();
            $gebruiker = \App\Gebruiker::where('email', $data['email'])->first();

            if ($gebruiker != null) {
                $nieuwwachtwoord = substr(md5(microtime()), rand(0, 26), 10);
                $gebruiker->password = bcrypt($nieuwwachtwoord);
                $gebruiker->eersteAanmelding = 1;
                $gebruiker->save();
                $this->sendMail($data['email'], 'Wachtwoord resetten - Gladiolen', '<h1>Wachtwoord resetten</h1><p>Uw nieuw wachtwoord is ' . $nieuwwachtwoord . '</p>');
            } else {
                throw new Exception('Gebruiker bestaat niet!');
            }
        }

        public function importArrayGebruikers(Request $request)
        {
            $data = $request->all();
            foreach ($data['gebruikers'] as $mogelijkegebruiker) {
                $vereniging = \App\Vereniging::where('naam', $mogelijkegebruiker['vereniging'])->first();

                if ($vereniging !== null) {
                    if (\App\Gebruiker::where('rijksregisternr', $mogelijkegebruiker['rijksregisternr'])->first() == null) {
                        unset($mogelijkegebruiker['vereniging']);
                        $gebruiker = \App\Gebruiker::create($mogelijkegebruiker);
                        $vereniging->gebruikers()->sync([$gebruiker->id], false);
                    } else {
                        $gebruiker = \App\Gebruiker::where('rijksregisternr', $mogelijkegebruiker['rijksregisternr'])->first();
                        $vereniging->gebruikers()->sync([$gebruiker->id], false);
                    }
                }
            }
            return response()->json(['Gebruikers' => 'Aangemaakt']);
        }

        public function sendMail($to, $subject, $body)
        {
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'testteamf12@gmail.com';
                $mail->Password = 'wijzijnteamf12';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('testteamf12@gmail.com');
                $mail->addAddress($to);
                $mail->addReplyTo('testteamf12@gmail.com');

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->send();

            } catch (Excemption $e) {
                echo 'Message could not be found';
            }
        }

        public function makeAnonymous($userId){
            $user = \App\Gebruiker::find($userId);
            $user->name = "Ano";
            $user->voornaam = "Niem";
            $user->roepnaam = "";
            $user->geboortedatum = date('Y/m/d');
            $user->email = "anoniem@mail.be";
            $user->telefoon = "0000";
            $user->opmerking = "Deze gebruiker is verwijderd en anoniem gemaakt";
            $user->rijksregisternr = "111111";
            $user->actief = 0;
            $user->password = null;
            $user->save();
        }
    }
