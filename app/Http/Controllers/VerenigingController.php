<?php

    namespace App\Http\Controllers;

    use App\Vereniging;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class VerenigingController extends Controller
    {
        public function index()
        {
            $verenigings = \App\Vereniging::with('hoofd', 'tweede', 'contact')->get();
            return response()->json($verenigings);
        }

        public function getVereniging($id)
        {
            $vereniging = \App\Vereniging::find($id);
            return response()->json($vereniging);
        }

        public function registreer(Request $request)
        {
            $data = $request->all();

            $vereniging = \App\Vereniging::create($data);
            $vereniging->save();

            return response()->json($vereniging);
        }

        public function getVerenigingMetLeden()
        {
            $user = Auth::user();
            $vereniging = \App\Vereniging::with('gebruikers.tshirts')->where('hoofdverantwoordelijke', $user->id)->first();
            return response()->json($vereniging);
        }

        public function getVerenigingVanIngelogdeGebruiker()
        {
            $user = Auth::user();
            $vereniging = \App\Vereniging::where('hoofdverantwoordelijke', $user->id)->first();

            return response()->json($vereniging);
        }

        public function updateVereniging($id, Request $request)
        {
            $data = $request->all();
            $vereniging = \App\Vereniging::find($id)->update($data);
            return response()->json($vereniging);
        }

        public function getVerenigingByIdMetLeden($id)
        {
            $vereniging = \App\Vereniging::with('gebruikers')->where('id', $id)->first();
            return response()->json($vereniging);
        }

        public function getVerenigingenInAanvraag()
        {
            $inaanvraag = \App\Vereniging::where('inAanvraag', 1)->with('hoofd')->get();
            return response()->json($inaanvraag);
        }

        public function acceptVereniging($id)
        {
            $teAccepteren = \App\Vereniging::find($id);
            $teAccepteren->inAanvraag = 0;
            $teAccepteren->save();
            return response()->json($teAccepteren);
        }

        public function denyVereniging($id)
        {
            $delete = \App\Vereniging::find($id);
            if ($delete->inAanvraag == 1) {
                $delete->delete();
            }
        }


    }
