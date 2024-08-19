<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request) {
        
        try {
            $user = $request->user();
            $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;
    
            if ($roleType == 'admin') {
                $property = Property::where('id', $request->property_id)->first();
            } else if ($roleType == 'property') {
                $property = $user->properties()->where('id', $request->property_id)->first();
            }
            // $bookings = Booking::where(['property_id'=>$request->id])->get();
            $rooms = $property->rooms()->get();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $rooms
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
