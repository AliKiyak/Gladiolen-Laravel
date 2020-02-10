<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaakgroepController extends Controller
{
    public function index()
    {
        $taakgroep = \App\Taakgroep::all();
        return response()->json($taakgroep);
    }
}
