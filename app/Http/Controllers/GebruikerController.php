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

}
