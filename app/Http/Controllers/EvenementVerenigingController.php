<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvenementVerenigingController extends Controller
{
    public function getVerenigingenByEvenementId($evenementId)
    {
        $verenigingen = \App\Vereniging::where('evenementId', $evenementId)->first();

        return response()->json($verenigingen);
    }
}
