<?php

namespace App\Http\Controllers;

use App\Tijdsregistratie;
use Illuminate\Http\Request;
use stdClass;

class TijdsregistratieController extends Controller
{
    public function index()
    {
        $tijdsregistraties = \App\Tijdsregistratie::with('gebruiker', 'evenement', 'vereniging')->get();
        return response()->json($tijdsregistraties);
    }

    public function addTijdsregistratie(Request $request)
    {
        $data = $request->all();

        $gebruiker = \App\Gebruiker::find($data['gberuiker_id']);
        $evenement = \App\Evenement::find($data['evenement_id']);
        $vereniging = \App\Vereniging::find($data['vereniging_id']);

        $tijdsregistratie = \App\Tijdsregistratie::create($data);
        $tijdsregistratie->gebruiker()->associate($gebruiker);
        $tijdsregistratie->evenement()->associate($evenement);
        $tijdsregistratie->vereniging()->associate($vereniging);

        $tijdsregistratie->save();

        return response()->json($tijdsregistratie);
    }

    public function updateTijdsregistratie($id, Request $request)
    {
        $data = $request->all();
        $tijdsregistratie = \App\Tijdsregistratie::find($id)->update($data);

        return response()->json($tijdsregistratie);
    }

    public function postTijdsregistratie(Request $request)
    {
        $data = $request->all();

        $registratie = new Tijdsregistratie;

        $gebruikerId = $data['gebruikerId'];
        $verenigingId = $data['verenigingId'];
        $evenementId = $data['evenementId'];

        $vorigeTijdsregistratie = \App\Tijdsregistratie::where(['gebruiker_id' => $gebruikerId, 'evenement_id' => $evenementId, 'vereniging_id' => $verenigingId])->orderBy('id', 'desc')->first();

        if (array_key_exists("checkInTime", $data)) {
            if ($vorigeTijdsregistratie == null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                $registratie->save();
            } elseif ($vorigeTijdsregistratie->checkIn == null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                $registratie->save();
            } elseif ($vorigeTijdsregistratie->checkUit == null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                $registratie->save();
                return response()->json($vorigeTijdsregistratie);
            } else {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                $registratie->save();
            }
        } else {
            if ($vorigeTijdsregistratie == null || $vorigeTijdsregistratie->checkIn == null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkUit = date('Y/m/d H:i:s', $data['checkOutTime']);
                $registratie->save();
                return response()->json($registratie);
            } elseif ($vorigeTijdsregistratie->checkUit == null) {
                $vorigeTijdsregistratie->checkUit = date('Y/m/d H:i:s', $data['checkOutTime']);
                $vorigeTijdsregistratie->save();
            } else {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkUit = date('Y/m/d H:i:s', $data['checkOutTime']);
                $registratie->save();
                return response()->json($registratie);
            }
        }

        return response()->json("");
    }
}
