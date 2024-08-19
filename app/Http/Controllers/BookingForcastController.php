<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;

class BookingForcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('startDate','endDate');
        return Inertia::render('BookingForcast/index');
    }
    public function selecteDate(Request $request){
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        
        Log::info('Selected start date: ' . $startDate);
        Log::info('Selected end date: ' . $endDate);
        
        session(['startDate' => $startDate]);
        session(['endDate' => $endDate]);
        

    }
    public function getData()
    {
      
        $startDate = session('startDate', date('Y-m-d'));

$endDate = session('endDate', date('Y-m-d', strtotime('+1 week')));
    if (strtotime($startDate) > strtotime($endDate)) {
        return response()->json(['error' => '']);
    }

        $backendProperty = PropertyController::getBackendProperty();
        if ($backendProperty) {
            $data = Property::findOrFail($backendProperty->id)
                ->bookings()
                ->whereBetween('checkin_date', [$startDate, $endDate])
                ->get();
        } else {
            $user = Auth::user();
            $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;
    
            if ($roleType == 'admin') {
                $data = Booking::whereBetween('checkin_date', [$startDate, $endDate])->get();
            } elseif ($roleType == 'property') {
                $ids = $user->properties()->pluck('id');
                $data = Booking::whereIn('property_id', $ids)
                    ->whereBetween('checkin_date', [$startDate, $endDate])
                    ->get();
            }
        }

        // Return data using DataTables
        return DataTables::of($data)
            ->addColumn('check', function ($row) {
                return '<div class="custom-control custom-checkbox item-check">
                    <input type="checkbox" class="form-check-input" id="' . $row->id . '" value="' . $row->id . '">
                    <label class="form-check-label form-check-label" for="' . $row->id . '"></label>
                </div>';
            })
            ->addColumn('customer', function ($row) {
                return $row->first_name . ' ' . $row->last_name;
            })
            ->addColumn('inv_id', function ($row) {
                return 'INV-' . $row->id;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'confirm') {
                    return '<span class="badge bg-success">Confirmed</span>';
                } else if ($row->status == 'cancel') {
                    return '<span class="badge bg-danger">Cancelled</span>';
                } else if ($row->status == 'pending') {
                    return '<span class="badge bg-primary">Pending</span>';
                } else {
                    return '<span class="badge bg-danger">Failed</span>';
                }
            })
            ->rawColumns(['check', 'status'])
            ->make(true);
    }
}
