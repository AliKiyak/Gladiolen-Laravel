<?php

namespace App\Http\Controllers;

use App\Vereniging;
use Illuminate\Http\Request;

class EvenementVerenigingController extends Controller
{
    public function getVerenigingenByEvenementId($evenementId)
    {
        $verenigingen = \App\EvenementVereniging::where('evenementId', $evenementId)->first();

        return response()->json($verenigingen);
    }

    public function registreerEvenementVereniging(Request $request)
    {
        $data = $request->all();
        $evenement = \App\Evenement::find($data["evenementid"]);
        $vereniging = \App\Vereniging::find($data["verenigingid"]);

        $evenement->verenigingen()->save($vereniging);

        return response()->json($evenement);
    }
}
