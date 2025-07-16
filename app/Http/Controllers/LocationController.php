<?php

namespace App\Http\Controllers;

use App\Models\Tambon;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces()
    {
        $provinces = Tambon::select('province', 'province_id')
            ->distinct()
            ->get();
        return response()->json($provinces);
    }

    public function getAmphoes(Request $request)
    {

        $province = $request->get('province');
        $amphoes = Tambon::select('amphoe_id', 'amphoe')
            ->where('province', $province)
            ->distinct()
            ->get();
        return $amphoes;
    }

    public function getTambons(Request $request)
    {

        $province = $request->get('province');
        $amphoe = $request->get('amphoe');
        $tambons = Tambon::select('tambon_id', 'tambon')
            ->where('province', $province)
            ->where('amphoe', $amphoe)
            ->distinct()
            ->get();
        return $tambons;
    }

    public function getZipcodes(Request $request)
    {

        $province = $request->get('province');
        $amphoe = $request->get('amphoe');
        $tambon = $request->get('tambon');
        $zipcodes = Tambon::select('zipcode')
            ->where('province', $province)
            ->where('amphoe', $amphoe)
            ->where('tambon', $tambon)
            ->get();
        return $zipcodes;
    }
}
