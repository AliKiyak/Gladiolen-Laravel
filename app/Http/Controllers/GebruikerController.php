<?php

namespace App\Http\Controllers;

use App\Gebruiker;
use App\Http\Requests\gebruikerRegistratieRequest;
use Illuminate\Http\Request;

class GebruikerController extends Controller
{
    public function registreer(gebruikerRegistratieRequest $request) {

        $data = $request->all();
        settype($data['tshirt_id'], 'integer');

        $tshirt = \App\Tshirt::find($data['tshirt_id']);
        $rol = \App\Rol::find(3);
        $data['tshirt_id'] = null;

        $gebruiker = \App\Gebruiker::create($data);
        $gebruiker->rol()->associate($rol);
        $gebruiker->tshirt()->associate($tshirt);

        $gebruiker->save();

        return response()->json($gebruiker);
    }
    public function index()
    {
        $lids = \App\Gebruiker::all();
        return response()->json($lids);
    }

    public function getLid($id) {
        $lid = \App\Gebruiker::find($id);

        return response()->json($lid);
    }
    public function addLid(Request $request) {
        $data = $request->all();

        $gebruiker = \App\Gebruiker::create($data);
        $rol = \App\Gebruiker::find(4);
        $gebruiker->rol()->associate($rol);

        // INGELOGDE HOOFDVERANTWOORDELIJKE REGELEN
        $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', 1)->first();

        $vereniging->gebruikers()->save($gebruiker);

        return response()->json($gebruiker);
    }

    public function deleteLid($id) {
        $lid = \App\Gebruiker::find($id);
        $lid->delete();
    }

    public function updateLid($id, Request $request) {
        $data = $request->all();
        $gebruiker = \App\Gebruiker::find($id)->update($data);

        return response()->json($gebruiker);
    }
}
