<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Amenity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    public function index(Request $request) {
        
        try {
            $amenityTypes = Amenity::where(['status'=>1])->get();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $amenityTypes
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }
}
