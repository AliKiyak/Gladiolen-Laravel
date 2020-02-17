<?php

namespace App\Http\Controllers;

use App\Vereniging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;

class VerenigingController extends Controller
{
    public function index()
    {
        $verenigings = \App\Vereniging::with('hoofd', 'tweede', 'contact')->get();
        return response()->json($verenigings);
    }

    public function getVereniging($id)
    {
        $vereniging = \App\Vereniging::find($id);
        return response()->json($vereniging);
    }

    public function getGeacepteerdeVerenigingen()
    {
        $verenigings = \App\Vereniging::with('hoofd', 'tweede', 'contact')->where('inAanvraag', 0)->get();
        return response()->json($verenigings);
    }

    public function registreer(Request $request)
    {
        $data = $request->all();

        $vereniging = \App\Vereniging::create($data);
        $vereniging->save();

        $body = '<h1>Aanvraag voor ' . $vereniging->naam . '</h1><p>Uw aanvraag is verzonden en wordt zo snel mogelijk verwerkt door onze medewerkers</p>';
        $this->sendMail($vereniging->hoofd->email, 'Aanvraag verzonden', $body);
        return response()->json($vereniging);
    }

    public function getVerenigingMetLeden()
    {
        $user = Auth::user();
        $vereniging = \App\Vereniging::with('gebruikers.tshirts','hoofd', 'tweede', 'contact')->where('hoofdverantwoordelijke', $user->id)->first();
        return response()->json($vereniging);
    }

    public function getVerenigingVanIngelogdeGebruiker()
    {
        $user = Auth::user();
        $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', $user->id)->first();

        return response()->json($vereniging);
    }

    public function updateVereniging($id, Request $request)
    {
        $data = $request->all();
        $vereniging = \App\Vereniging::find($id)->update($data);
        return response()->json($vereniging);
    }

    public function getVerenigingByIdMetLeden($id)
    {
        $vereniging = \App\Vereniging::with('gebruikers')->where('id', $id)->first();
        return response()->json($vereniging);
    }

    public function getVerenigingenInAanvraag()
    {
        $inaanvraag = \App\Vereniging::where('inAanvraag', 1)->with('hoofd')->get();
        return response()->json($inaanvraag);
    }

    public function acceptVereniging($id,$verid)
    {
        $teAccepteren = \App\Vereniging::with('hoofd')->find($id);
        $body = '<h1>Aanvraag voor ' . $teAccepteren->naam . '</h1><p>Uw aanvraag is geaccepteerd. U kan nu leden toevoegen aan uw vereniging.</p>';
        $this->sendMail($teAccepteren->hoofd->email, 'Aanvraag geaccepteerd', $body);
        $teAccepteren->inAanvraag = 0;
        $teAccepteren->contactpersoon = $verid;
        $teAccepteren->save();
        return response()->json($teAccepteren);
    }

    public function denyVereniging($id)
    {
        $delete = \App\Vereniging::with('hoofd')->find($id);
        $body = '<h1>Aanvraag voor ' . $delete->naam . '</h1><p>Na het bekijken van uw aanvraag, zijn we tot het besluit gekomen dat uw vereniging ni</p>';
        $this->sendMail($delete->hoofd->email, 'Aanvraag geweigerd', $body);
        if ($delete->inAanvraag == 1) {
            $delete->delete();
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
