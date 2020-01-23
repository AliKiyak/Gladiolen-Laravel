<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $rols = \App\Rol::all();
        return response()->json($rols);
    }
}
