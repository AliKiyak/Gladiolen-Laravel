<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function index() {
        $tshirts = \App\Tshirt::all();
        return response()->json($tshirts);
    }

    public function create(Request $request) {
        $data = $request->all();

        $tshirt = \App\Tshirt::create($data);

        return response()->json($tshirt);
    }

    public function updateLidGeslachtEnMaat($id, Request $request) {
        $data = $request->all();

        $tshirt = \App\Tshirt::where("gebruiker_id", $id);
        $tshirt->update($data);

        return response()->json($tshirt);
    }
}
