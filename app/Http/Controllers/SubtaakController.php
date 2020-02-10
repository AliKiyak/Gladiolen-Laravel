<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubtaakController extends Controller
{
    public function index()
    {
        $subtaak = \App\Subtaak::all();
        return response()->json($subtaak);
    }
}
