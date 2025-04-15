<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function index()
    {
        // Use select() to only get needed columns
        $divisions = Division::select(['id', 'code as name'])->get();
        return view('dependent-dropdown', compact('divisions'));
    }

    public function getDistricts($divisionCode)
    {
        // Single query with join for better performance
        $districts = District::select('districts.code as name', 'districts.id')
            ->join('divisions', 'districts.division_id', '=', 'divisions.id')
            ->where('divisions.code', $divisionCode)
            ->get();

        return response()->json($districts);
    }

    public function getUpazilas($districtCode)
    {
        // Single query with join for better performance
        $upazilas = Upazila::select('upazilas.code as name', 'upazilas.id')
            ->join('districts', 'upazilas.district_id', '=', 'districts.id')
            ->where('districts.code', $districtCode)
            ->get();

        return response()->json($upazilas);
    }
}
