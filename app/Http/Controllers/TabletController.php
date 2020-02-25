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
                $data["laatstGeupdatet"] = date_create()->format('Y-m-d H:i:s');
                $tablet = \App\Tablet::create($data);

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
