<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\BedType;
use Illuminate\Http\Request;

class BedTypeController extends Controller
{
    public function index(Request $request) {
        
        try {
            $bedTypes = BedType::where(['status'=>1])->get();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $bedTypes
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
