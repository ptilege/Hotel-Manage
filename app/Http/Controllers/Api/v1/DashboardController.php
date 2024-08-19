<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        try {
            $user = $request->user();
            $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;
    
            if ($roleType == 'admin') {
                $property = Property::with('propertyType');
            } else if ($roleType == 'property') {
                $property = $user->properties()->with('propertyType');
            }

            $monthlyBookingList = array();
            $monthList = array();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
    
            for ($i = 1; $i < $currentMonth + 1; $i++) {
                array_push($monthList, Carbon::create()->month($i)->format('M'));
                $bookingCount =$user->properties()->where(['id'=>$request->property_id])->first()->bookings()->whereMonth('created_at', $i)->whereYear('created_at', $currentYear)->count();
                array_push($monthlyBookingList, $bookingCount);
            }

            $data = array(
                "total_bookings" => $property->where(['id'=>$request->property_id])->first()->bookings()->count(),
                "pending_bookings" => $property->where(['id'=>$request->property_id])->first()->bookings()->where(['status'=> 'pending'])->count(),
                "total_properties" => $user->properties()->count(),
                "total_rooms" => $property->where(['id'=>$request->property_id])->first()->rooms()->count(),
                "total_offers" => $property->where(['id'=>$request->property_id])->first()->offers()->count(),
                "chart" => array("months"=>$monthList, "count"=>$monthlyBookingList),
            );

            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $data
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
