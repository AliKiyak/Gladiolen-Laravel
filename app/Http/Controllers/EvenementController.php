<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = \App\Evenement::with('verenigingen')->orderBy("actief",'desc')->orderBy('id', 'desc')->get();;
        return response()->json($evenements);
    }

    public function registreer(Request $request)
    {
        $data = $request->all();

        $evenement = \App\Evenement::create($data);
        $evenement->save();

        return response()->json($evenement);
    }

    public function updateEvenement($id, Request $request)
    {
        $data = $request->all();
        $evenement = \App\Evenement::find($id)->update($data);
        return response()->json($evenement);
    }

    public function getEvenement($id)
    {
        $evenement = \App\Evenement::find($id);

        return response()->json($evenement);
    }

    public function getActieveEvenementen()
    {
        $evenementen = \App\Evenement::where('actief', 1)->orderBy('id', 'desc')->get();
        return response()->json($evenementen);
    }

    public function getGebruikersFromEvenement($evenementId)
    {
        //$evenement = \App\Evenement::all();
        $evenement = \App\Evenement::with('verenigingen')->where('id', $evenementId)->first();
        $verenigingIds = [];
        foreach ($evenement->verenigingen as $v) {
            array_push($verenigingIds, $v->id);
        }
        $gebruikers = [];

        foreach ($verenigingIds as $id) {
            $vereniging = \App\Vereniging::where("id", $id)->with('gebruikers')->first();

            foreach ($vereniging->gebruikers as $gebruiker) {
                $temp = \App\Gebruiker::with('verenigingen')->find($gebruiker->id);
                if (!in_array($temp, $gebruikers)) {
                    array_push($gebruikers, $temp);
                }

            }

        }

        return response()->json($gebruikers);
    }
}
