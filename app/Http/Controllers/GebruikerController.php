<?php

namespace App\Http\Controllers;

use App\Gebruiker;
use App\Http\Requests\gebruikerRegistratieRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GebruikerController extends Controller
{
    public function login(Request $request) {
        $data = $request->all();

        if(Auth::attempt(['email'=>$data['email'], 'password' => $data['password']])) {
            $user= Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json($success);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function registreerVerantwoordelijke(gebruikerRegistratieRequest $request)
    {

        $data = $request->all();

        $rol = \App\Rol::find(3);
        $data['password'] = bcrypt($data['password']);
        $gebruiker = \App\Gebruiker::create($data);
        $gebruiker->rol()->associate($rol);

        $gebruiker->save();

        return response()->json($gebruiker);
    }

    public function registreerGebruiker(gebruikerRegistratieRequest $request)
    {
        $data = $request->all();

        $rol = \App\Rol::find($data['rol_id']);

        $gebruiker = \App\Gebruiker::create($data);
        $gebruiker->rol()->associate($rol);

        $gebruiker->save();

        return response()->json($gebruiker);
    }

    public function index()
    {
        $lids = \App\Gebruiker::with('rol')->get();
        return response()->json($lids);
    }

    public function getGebruiker($id)
    {
        $gebruiker = \App\Gebruiker::find($id);
        return response()->json($gebruiker);
    }

    public function getKernleden(){
        $kernleden = \App\Gebruiker::where('rol_id', 2)->get();
        return response()->json($kernleden);
    }
    public function getLid($id)
    {
        $lid = \App\Gebruiker::with('tshirts')->find($id);
        return response()->json($lid);
    }

    public function addLid(Request $request)
    {
        $data = $request->all();

        $gebruiker = \App\Gebruiker::create($data);
        $rol = \App\Gebruiker::find(4);

        $gebruiker->rol()->associate($rol);
        $gebruiker->save();

        $user = Auth::user();
        $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', $user->id)->first();
        $vereniging->gebruikers()->save($gebruiker);

        return response()->json($gebruiker);
    }

    public function deleteLid($id)
    {
        $lid = \App\Gebruiker::find($id);
        $lid->delete();
    }

    public function updateLid($id, Request $request)
    {
        $data = $request->all();
        $gebruiker = \App\Gebruiker::find($id)->update($data);

        return response()->json($gebruiker);
    }

        public function detailIngelogdeGebruiker() {
        $user = Auth::user();
        return response()->json($user);
    }


}
