<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request) {

        try {
            $user = $request->user();
            $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;
    
           // dd($user);
            if ($roleType == 'admin') {
                $property = Property::with('propertyType')->get();
            } else if ($roleType == 'property') {
                $property = $user->properties()->with('propertyType')->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $property
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }

    public function create(Request $request) {}

    public function update(Request $request) {}

    public function delete(Request $request) {}
}
