<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    /**
     * Display the location selection form
     */
    public function index()
    {
        $divisions = Division::select(['id', 'name'])
            ->orderBy('name')
            ->get();

        return view('dependent-dropdown', compact('divisions'));
    }

    /**
     * Get districts for a division (AJAX)
     */
    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();

        return response()->json($districts);
    }

    /**
     * Get upazilas for a district (AJAX)
     */
    public function getUpazilas($districtId)
    {
        $upazilas = Upazila::where('district_id', $districtId)
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();

        return response()->json($upazilas);
    }

    /**
     * Save the selected location (AJAX)
     */
    public function saveLocation(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Location saved successfully',
            'data' => $validated
        ]);
    }
}
