<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;

class DropdownController extends Controller
{
    public function index()
    {
        $divisions = Division::select(['id', 'code as name'])->get();
        return view('dependent-dropdown', compact('divisions'));
    }

    public function getDistricts($divisionCode)
    {

        $districts = District::select('districts.code as name', 'districts.id')
            ->join('divisions', 'districts.division_id', '=', 'divisions.id')
            ->where('divisions.code', $divisionCode)
            ->get();

        return response()->json($districts);
    }

    public function getUpazilas($districtCode)
    {
        $upazilas = Upazila::select('upazilas.code as name', 'upazilas.id')
            ->join('districts', 'upazilas.district_id', '=', 'districts.id')
            ->where('districts.code', $districtCode)
            ->get();

        return response()->json($upazilas);
    }
}
