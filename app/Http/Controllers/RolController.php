<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $rols = \App\Rol::all();
        return response()->json($rols);
    }

    public function getRol(){
        $user = Auth::user();
        $gebruiker = \App\Gebruiker::where('id', $user->id)->first();
        $rol = $gebruiker->rol_id;

        return($rol);
    }

    public function getRolIdWhereNaam(String $naam){
        $rol = \App\Rol::where('naam', $naam)->first();
        $rolId = $rol->id;

        return($rolId);
    }
}
