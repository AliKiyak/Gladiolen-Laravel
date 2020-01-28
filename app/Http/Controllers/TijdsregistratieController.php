<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TijdsregistratieController extends Controller
{

    public function postTijdsregistratie(Request $request){
        $data = $request->all();

        //var_dump($data);

        $gebruikerId = $data['gebruikerId'];
        $verenigingId = $data['verenigingId'];
        $evenementId = $data['evenementId'];



        //$evenementVereniging = \App\EvenementVereniging::where(['vereniging_id'=> $verenigingId,'evenement_id'=>$evenementId])->first();



        $vorigeTijdsregistratie = \App\Tijdsregistratie::where(['gebruiker_id'=> $gebruikerId,'evenement_id'=>$evenementId, 'vereniging_id' => $verenigingId])->orderBy('id', 'desc')->first();

        if(!$data['checkInTime']==null){
            if($vorigeTijdsregistratie==null)
            {
                $registratie->gebruiker_id = $gebruikerId
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = $data['checkInTime'];
                \App\Tijdsregistratie::create($registratie);
            }
            elseif($vorigeTijdsregistratie->checkIn==null) {
                $registratie->gebruiker_id = $gebruikerId
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = $data['checkInTime'];
                \App\Tijdsregistratie::create($registratie);
                return json($vorigeTijdsregistratie);
            }
            elseif($vorigeTijdsregistratie->checkOut==null){
                $registratie->gebruiker_id = $gebruikerId
                $registratie->evenement_id = $evenementId;
                $registratie->vereniging_id = $verenigingId;
                $registratie->checkIn = $data['checkInTime'];
                \App\Tijdsregistratie::create($registratie);
                return json($vorigeTijdsregistratie);
            }
        }
        else{
            if($vorigeTijdsregistratie->checkOut==null){

            }
            else{

            }

        }

        //var_dump($vorigeTijdsregistratie);


        //$tijdsregistratie = \App\Tijdsregistratie::create($data);




        //return response()->json($vorigeTijdsregistratie);
    }
}
