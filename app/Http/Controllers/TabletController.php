<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\Tablet;
    use Illuminate\Http\Request;

    class TabletController extends Controller
    {
        public function updateTablet(Request $request)
        {
            $data = $request->all();

            $dezeTablet = \App\Tablet::where("tabletCode", $data["tabletCode"])->first();
            if ($dezeTablet == null) {
                $tablet = \App\Tablet::create();
                $tablet->tabletCode = $data["tabletCode"];
                $tablet->tabletnaam = $data["tabletnaam"];
                $tablet->batterijpercentage = $data["batterijpercentage"];
                $tablet->laatstGeupdatet = date_create()->format('Y-m-d H:i:s');
                $tablet->save();
            } else {
                $dezeTablet->tabletnaam = $data["tabletnaam"];
                $dezeTablet->batterijpercentage = $data["batterijpercentage"];
                $dezeTablet->laatstGeupdatet = date_create()->format('Y-m-d H:i:s');
                $dezeTablet->save();
            }

        }

        public function index()
        {
            $tablets = \App\Tablet::all();
            return response()->json($tablets);
        }
    }
