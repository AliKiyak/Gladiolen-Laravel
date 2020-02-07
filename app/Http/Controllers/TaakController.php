<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaakController extends Controller
{
    public function index()
    {
        $taken = \App\Taak::all();
        return response()->json($taken);
    }

    public function addTaak(Request $request)
    {
        $data = $request->all();
        $taak = \App\Taak::create($data);
        $taak->save();

        return response()->json($taak);
    }

    public function updateTaak($id, Request $request)
    {
        $data = $request->all();
        $taak = \App\Taak::find($id)->update($data);

        return response()->json($taak);
    }
}
