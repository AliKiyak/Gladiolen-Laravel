<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvenementVerenigingController extends Controller
{
    public function getVerenigingenByEvenementId($evenementId)
    {
        $verenigingen = \App\EvenementVereniging::where('evenementId', $evenementId)->first();

        return response()->json($verenigingen);
    }

    public function registreerEvenementVereniging(evenementVerenigingRegistratieRequest $request)
    {
        $data = $request->all();

        $evenementVereniging = \App\EvenementVereniging::create($data);
        $evenementVereniging->save();

        return response()->json($evenementVereniging);
    }
}
