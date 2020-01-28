<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TijdsregistratieController extends Controller
{
    //

    public function postTijdsregistratie(Request $request){
        $data = $request->all();

        $verenigingId = $data['verenigingId'];
        $evenementId = $data['evenementId'];

        $evenementVereniging = \App\EvenementVereniging::where(['vereniging_id'=> $verenigingId,
        'evenement_id'=>$evenementId])->first();

        dd($evenementVereniging);

        //$vorigeTijdsregistratie = \App\Tijdsregistratie::where($gebruiker_id, $data->gebruikerId)->orderBy('id', 'desc')->first();



        //$tijdsregistratie = \App\Tijdsregistratie::create($data);




        //return response()->json($vorigeTijdsregistratie);
    }
}
