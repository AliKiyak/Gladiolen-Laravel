<?php

namespace App\Http\Controllers;

use App\Tijdsregistratie;
use Illuminate\Http\Request;
use stdClass;

class TijdsregistratieController extends Controller
{
    public function index()
    {
        $tijdsregistraties = \App\Tijdsregistratie::with('gebruiker')->get();
        return response()->json($tijdsregistraties);
    }

    public function postTijdsregistratie(Request $request)
    {
        $data = $request->all();


        $registratie = new Tijdsregistratie;

        $gebruikerId = $data['gebruikerId'];
        $verenigingId = $data['verenigingId'];
        $evenementId = $data['evenementId'];

        $vorigeTijdsregistratie = \App\Tijdsregistratie::where(['gebruiker_id' => $gebruikerId, 'evenement_id' => $evenementId, 'vereniging_id' => $verenigingId])->orderBy('id', 'desc')->first();


        if (!$data['checkInTime'] == null) {
            if ($vorigeTijdsregistratie == null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                echo "1";
                $registratie->save();
            } elseif ($vorigeTijdsregistratie->checkIn == null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                echo "2";
                $registratie->save();
            } elseif ($vorigeTijdsregistratie->checkUit == null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                echo "3";
                $registratie->save();
                return response()->json($vorigeTijdsregistratie);
            }
            else{
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = date('Y/m/d H:i:s', $data['checkInTime']);
                echo "8";
                $registratie->save();
            }
        } else {
            if ($vorigeTijdsregistratie == null || $vorigeTijdsregistratie->checkIn==null) {
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkUit = date('Y/m/d H:i:s', $data['checkOutTime']);
                echo "4";
                $registratie->save();
                return response()->json($registratie);
            }
            elseif($vorigeTijdsregistratie->checkUit==null){
                $vorigeTijdsregistratie->checkUit = date('Y/m/d H:i:s', $data['checkOutTime']);
                $vorigeTijdsregistratie->save();
                echo "5";
            }
            else{
                $registratie->gebruiker_id = $gebruikerId;
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkUit = date('Y/m/d H:i:s', $data['checkOutTime']);
                echo "9";
                $registratie->save();
                return response()->json($registratie);
            }
        }

        return response()->json("");
    }
}
