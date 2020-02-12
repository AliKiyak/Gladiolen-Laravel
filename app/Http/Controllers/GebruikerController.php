<?php

namespace App\Http\Controllers;

use App\Gebruiker;
use App\Http\Requests\gebruikerRegistratieRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class GebruikerController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json($success);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function registreerVerantwoordelijke(Request $request)
    {
        $data = $request->all();

        if(\App\Gebruiker::where('email', $data['email'])->first() == null) {
            $rol = \App\Rol::find(3);
            $data['password'] = bcrypt($data['password']);
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
        $nieuwwachtwoord = substr(md5(microtime()),rand(0,26),10);
        $data['password'] = bcrypt($nieuwwachtwoord);
        $rol = \App\Rol::find($data['rol_id']);
        $gebruiker = \App\Gebruiker::create($data);

        $gebruiker->rol()->associate($rol);

        $gebruiker->save();
        $this->sendMail($gebruiker->email, 'Account Gladiolen Aangemaakt', '<h1>Uw account voor Keizer Karel is
                        aangemaakt!</h1><p>U kan nu inloggen met uw e-mail en het volgende wachtwoord ' . $nieuwwachtwoord.'</p>' .
            '<p>Vergeet niet om uw wachtwoord te veranderen!</p>');
        return response()->json($gebruiker);
    }

    public function index()
    {
        $lids = \App\Gebruiker::with('rol')->get();
        return response()->json($lids);
    }

    public function getGebruiker($id)
    {
        $gebruiker = \App\Gebruiker::with('tshirts', 'rol')->find($id);
        return response()->json($gebruiker);
    }

    public function getVrijwilligers($verenigingId)
    {
        $vereniging = \App\Vereniging::with('gebruikers', 'gebruikers.rol')->find($verenigingId);
        //var_dump($vereniging);
        $vrijwilligers = $vereniging->gebruikers;
        //var_dump($vrijwilligers);
        return response()->json($vrijwilligers);
    }

    public function getKernleden()
    {
        $kernleden = \App\Gebruiker::where('rol_id', 2)->get();
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
        } else {
            $gebruiker = \App\Gebruiker::where('rijksregisternr', $data['rijksregisternr'])->first();
        }

        $rol = \App\Rol::find(4);

        $gebruiker->rol()->associate($rol);
        $gebruiker->save();

        $user = Auth::user();
        $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', $user->id)->first();
        $vereniging->gebruikers()->save($gebruiker);

        return response()->json($gebruiker);
    }

    public function deleteLid($id)
    {
        $lid = \App\Gebruiker::find($id);
        $lid->delete();
    }

    public function updateLid($id, Request $request)
    {
        $data = $request->all();
        $data['wachtwoord'] =
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
            $nieuwwachtwoord = substr(md5(microtime()),rand(0,26),10);
            $gebruiker->password = bcrypt($nieuwwachtwoord);
            $gebruiker->save();
            $this->sendMail($data['email'],'Wachtwoord resetten - Gladiolen', '<h1>Wachtwoord resetten</h1><p>Uw nieuw wachtwoord is ' . $nieuwwachtwoord . '</p>' );
        } else {
            throw new Exception('Gebruiker bestaat niet!');
        }
    }

    public function sendMail($to, $subject ,$body) {
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
}
