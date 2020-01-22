<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerenigingController extends Controller
{
    public function registreer(Request $request) {
        $data = $request->all();

        $vereniging = \App\Vereniging::create($data);
        $vereniging->save();

        return response()->json($vereniging);
    }

    public function getLedenVanEigenVereniging() {
        $vereniging = \App\Vereniging::with('gebruikers')->where('hoofdverantwoordelijke', 1)->first();

        return response()->json($vereniging);
    }

}
