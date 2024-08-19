<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller 
{
    public function index(Request $request) {
        
        try {
            $destination = Destination::where(['status'=>1])->get();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $destination
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
