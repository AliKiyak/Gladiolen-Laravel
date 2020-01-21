<?php

namespace App\Http\Controllers;

use App\Gebruiker;
use Illuminate\Http\Request;

class GebruikerController extends Controller
{
    public function registreer() {
        $data = request();

        $nieuweGebruiker = Gebruiker::create($data);

        return response()->json($nieuweGebruiker);
    }
}
