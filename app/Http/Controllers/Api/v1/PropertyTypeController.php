<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index(Request $request) {
        
        try {
            $propertyTypes = PropertyType::where(['status'=>1])->get();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $propertyTypes
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
