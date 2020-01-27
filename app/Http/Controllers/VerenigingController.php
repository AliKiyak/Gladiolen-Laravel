<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerenigingController extends Controller
{
    public function index()
    {
        $verenigings = \App\Vereniging::all();
        return response()->json($verenigings);
    }

    public function getVereniging($id)
    {
        $vereniging = \App\Vereniging::find($id);
        return response()->json($vereniging);
    }

    public function registreer(Request $request)
    {
        $data = $request->all();

        $vereniging = \App\Vereniging::create($data);
        $vereniging->save();

        return response()->json($vereniging);
    }

    public function getVerenigingMetLeden()
    {
        //AANPASSEN MET JSON LOGIN TOKEN
        //TODO AANPASSEN JSON LOGIN TOKEN
        $vereniging = \App\Vereniging::with('gebruikers')->where('hoofdverantwoordelijke', 1)->first();
        return response()->json($vereniging);
    }

    public function getVerenigingVanIngelogdeGebruiker()
    {
        //TODO UPDATE JWT
        $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', '1')->first();

        return response()->json($vereniging);
    }

    public function updateVereniging($id, Request $request)
    {
        $data = $request->all();
        $vereniging = \App\Vereniging::find($id)->update($data);
        return response()->json($vereniging);
    }

}
