<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = \App\Evenement::all();
        return response()->json($evenements);
    }

    public function registreer(Request $request)
    {
        $data = $request->all();

        $evenement = \App\Evenement::create($data);
        $evenement->save();

        return response()->json($evenement);
    }
}
