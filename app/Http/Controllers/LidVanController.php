<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LidVanController extends Controller
{
    public function index() {
        $vereniging  = LidVanController::with('gebruiker')->get();

        return json($vereniging);
    }
}
