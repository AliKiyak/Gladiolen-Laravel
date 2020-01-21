<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function index() {
        $tshirts = \App\Tshirt::all();
        return response()->json($tshirts);
    }
}
