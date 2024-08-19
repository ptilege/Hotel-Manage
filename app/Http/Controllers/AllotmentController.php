<?php

namespace App\Http\Controllers;

use App\Models\Allotment;
use App\Models\ChannelManager;
use App\Models\Property;
use App\Models\Room;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AllotmentController extends Controller
{
    public function index()
    {
        $backendProperty = PropertyController::getBackendProperty();
        if ($backendProperty) {
            $data = Property::findOrFail($backendProperty->id)->rooms()->get();
            $allotments = Allotment::where('property_id', $backendProperty->id)->with('room')->get()->groupBy('room_id')->toArray();
        } else {
            $data = collect([]);
            $allotments = collect([])->toArray();
        }

        // $allotments = DB::table('allotments')->where('property_id', $backendProperty->id)->with('room')->get()->groupBy('room_id')->toArray();
        // dd($allotments);
        return Inertia::render('Allotments/Index', ['roomTypes' => $data, 'allotments' => $allotments]);
    }

    public function store(Request $request)
    {
        $room = Room::findOrFail($request->room_type);
        $request->validate([
            'room_type' => ['required'],
            'qty' => ['required', 'numeric', 'max:' . $room->web_quantity],
            'from_date' => ['required'],
            'to_date' => ['required'],
        ], [
            'qty.max' => 'The Number of Rooms must not be greater than ' . $room->web_quantity
        ]);

        try {
            $backendProperty = PropertyController::getBackendProperty();
            if ($backendProperty) {
                $propertyId = $backendProperty->id;
            } else {
                $propertyId = 0;
            }

            $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date);

            $dateRange = CarbonPeriod::create($startDate, $endDate);
            $dateRange =  $dateRange->toArray();

            foreach ($dateRange as $key => $date) {
                DB::beginTransaction();

                $allotments = Allotment::where('room_id', $request->room_type)->where('date', $date->format('Y-m-d'))->first();
                //dd($allotments);

                if (!$allotments) {
                    $model = new Allotment();
                    $model->date = $date->format('Y-m-d');
                    $model->qty = $request->qty;
                    $model->property_id = $propertyId;
                    $model->room_id = $request->room_type;
                    $model->save();
                }
                DB::commit();
            }



            $channelManager = $this->checkChannelManagerIsActive($propertyId);
            // dd($channelManager);
            if($channelManager) {
                $cmData = [
                    'from_date' =>  $request->from_date,
                    'to_date'   =>  $request->to_date,
                    'room_id'   =>  $request->room_type,
                    'qty'       =>  $request->qty,
                    'prop_key'  =>  $channelManager->property_key,
                    'prop_id'   =>  $channelManager->channel_m_prop_id
                ];

                $cmController = new ChannelManagerController();
                $cmController->setAllotments($cmData);
            }

            // dd($dateRange);

            return redirect()->route('allotments.index');
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return abort(500);
        }
    }

    public function update(Request $request)
    {
        $room = Room::findOrFail($request->room_type);
        $request->validate([
            'room_type' => ['required'],
            'qty' => ['required', 'numeric', 'max:' . $room->web_quantity],
            'from_date' => ['required'],
            'to_date' => ['required'],
        ], [
            'qty.max' => 'The Number of Rooms must not be greater than ' . $room->web_quantity
        ]);

        try {
            $backendProperty = PropertyController::getBackendProperty();
            if ($backendProperty) {
                $propertyId = $backendProperty->id;
            } else {
                $propertyId = 0;
            }

            $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date);

            $dateRange = CarbonPeriod::create($startDate, $endDate);
            $dateRange =  $dateRange->toArray();

            foreach ($dateRange as $key => $date) {
                DB::beginTransaction();

                $allotments = Allotment::where('room_id', $request->room_type)->where('date', $date->format('Y-m-d'))->first();

                if ($allotments) {
                    $model = Allotment::find($allotments->id);
                    $model->date = $date->format('Y-m-d');
                    $model->qty = $request->qty;
                    $model->property_id = $propertyId;
                    $model->room_id = $request->room_type;
                    $model->save();
                }
                DB::commit();
            }

            // dd($dateRange);

            return redirect()->route('allotments.index');
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollBack();
            return abort(500);
        }
    }

    public function destroy(Request $request)
    {
        
        try {
            if($request->from_date == $request->to_date) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $request->from_date.' 00:00:00')->toDateTimeString();
                $allotments = Allotment::where('id', $request->id)->where('date', $date)->first();
                // dd($allotments);
                if($allotments) {

                    Allotment::destroy($allotments->id);
                }
            }
            return redirect(route('allotments.index'));
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect(route('allotments.index'));
        }
    }

    public function checkChannelManagerIsActive($propertyId){
        $cm = ChannelManager::where('property_id',$propertyId)->first();
        if($cm) {
            return $cm;
        } else {
            return false;
        }
    }
}
