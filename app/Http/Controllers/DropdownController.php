<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;

class DropdownController extends Controller
{
    public function index()
    {
        $divisions = Division::select(['id', 'name'])->get();
        return view('dependent-dropdown', compact('divisions'));
    }

    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)
            ->get(['id', 'name']);
        return response()->json($districts);
    }

    public function getUpazilas($districtId)
    {
        $upazilas = Upazila::where('district_id', $districtId)
            ->get(['id', 'name']);
        return response()->json($upazilas);
    }
}
