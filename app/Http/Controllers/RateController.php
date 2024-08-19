<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Rate;
use App\Models\Room;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Beds24Service\Beds24Service;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Rates/Index');
    }

    public function getData()
    {
        $backendProperty = PropertyController::getBackendProperty();
        if ($backendProperty) {
            $data = Property::findOrFail($backendProperty->id)->rates()->get();
        } else {
            $data = collect([]);
        }

        return DataTables::of($data)
            ->addColumn('check', function ($row) {
                return '<div class="custom-control custom-checkbox item-check">
            <input type="checkbox" class="form-check-input" id="' . $row->id . '" value="' . $row->id . '">
            <label class="form-check-label form-check-label" for="' . $row->id . '"></label>
          </div>';
            })
            ->addColumn('action',  function ($row) {
                $action_html = '';
                if (auth()->user()->can('room.view') && auth()->user()->can('room.edit')) {
                    $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('room.edit')) {
                    $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('room.delete')) {
                    $action_html .= '<a class="dropdown-item text-danger action_delete" data-bs-toggle="modal" data-bs-target="#deleteConfirm" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-trash mr-2"></i> Delete</a> ';
                }
                return '<div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="min-width: 10rem;">
                                ' . $action_html . '
                                </div>
                            </div>';
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-warning">Inactive</span>';
                }
            })
            ->addColumn('room_type', function ($row) {
                $room = Room::find($row->room_id);
                return $room? $room->first()->name : '';
            })
            ->rawColumns(['check', 'action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $rooms = [];
        $bedTypes = [];
        $mealTypes = [];
        $baseRates = [];

        $backendProperty = PropertyController::getBackendProperty();
        if ($backendProperty) {
            $property = Property::findOrFail($backendProperty->id);
            $rooms = $property->rooms()->get();
            $bedTypes = $property->bedTypes()->get();
            $mealTypes = $property->mealTypes()->get();
            $baseRates = $property->rates()->where(['type' => 'base'])->get();
        }
        return Inertia::render('Rates/CreateUpdate', compact('rooms', 'bedTypes', 'mealTypes', 'baseRates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Beds24Service $beds24Service)
    {
        $request->validate([
            'name' => 'required',
            'plan_type' => 'required',
            'room_type' => 'required',
            'meal_type' => 'required',
            'bed_type' => 'required',
            'status' => 'required'
        ]);
        if($request->plan_type == 'normal') {
            $request->validate([
                'base_rate'=>'required'
            ]);
        }
        //dd($request->all());
        try {
            $backendProperty = PropertyController::getBackendProperty();
            $propertyId = $backendProperty ? $backendProperty->id : 0;

            DB::beginTransaction();
            $model = new Rate();
            $model->name = $request->name;
            $model->property_id = $propertyId;
            $model->room_id = $request->room_type;
            $model->bed_type_id = $request->bed_type;
            $model->meal_type_id = $request->meal_type;
            $model->price_per = $request->price_per;
            $model->price_per_foreign = $request->price_per_foreign;
            $model->price = $request->local_price;
            $model->price_extra_person = $request->local_price_extra_person;
            $model->price_extra_child = $request->local_price_extra_child;
            $model->foreign_price = $request->foreign_price;
            $model->foreign_price_extra_person = $request->foreign_price_extra_person;
            $model->foreign_price_extra_child = $request->foreign_price_extra_child;
            $model->from_date = $request->from_date ?? Carbon::now();
            $model->to_date = $request->to_date ?? Carbon::now();
            $model->base_rate_id = $request->base_rate;
            $model->status = $request->status;
            $model->type = $request->plan_type;
            $model->save();
            $beds24Data = [
                'name' => $model->name,
                'property_id' => $model->property_id,
                'room_id' => $model->room_id,
                'bed_type_id' => $model->bed_type_id,
                'meal_type_id' => $model->meal_type_id,
                'price' => $model->price,
                'from_date' => $model->from_date,
                'to_date' => $model->to_date,
            ];
    
            
            $beds24Response = $beds24Service->setRate($beds24Data);
            Log::info('Beds24Response: ' . print_r($beds24Response, true));
            DB::commit();
            return redirect()->route('rates.index');
        } catch (Exception $ex) {
            //throw $th;
            dd($ex);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms = [];
        $bedTypes = [];
        $mealTypes = [];

        $data = Rate::findOrFail($id);
        $backendProperty = PropertyController::getBackendProperty();
        if ($backendProperty) {
            $property = Property::findOrFail($backendProperty->id);
            $rooms = $property->rooms()->get();
            $bedTypes = $property->bedTypes()->get();
            $mealTypes = $property->mealTypes()->get();
            $baseRates = $property->rates()->where(['type' => 'base'])->get();
        }
        return Inertia::render('Rates/CreateUpdate', compact('data', 'rooms', 'bedTypes', 'mealTypes', 'baseRates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'plan_type' => 'required',
            'room_type' => 'required',
            'meal_type' => 'required',
            'bed_type' => 'required',
            'status' => 'required'
        ]);

        if($request->plan_type == 'normal') {
            $request->validate([
                'base_rate'=>'required'
            ]);
        }
         //dd($request->all());
        try {
            $backendProperty = PropertyController::getBackendProperty();
            $propertyId = $backendProperty ? $backendProperty->id : 0;

            DB::beginTransaction();
            $model = Rate::findOrFail($request->id);
            $model->name = $request->name;
            $model->property_id = $propertyId;
            $model->room_id = $request->room_type;
            $model->bed_type_id = $request->bed_type;
            $model->meal_type_id = $request->meal_type;
            $model->price_per = $request->price_per;
            $model->price_per_foreign = $request->price_per_foreign;
            $model->price = $request->local_price;
            $model->price_extra_person = $request->local_price_extra_person;
            $model->price_extra_child = $request->local_price_extra_child;
            $model->foreign_price = $request->foreign_price;
            $model->foreign_price_extra_person = $request->foreign_price_extra_person;
            $model->foreign_price_extra_child = $request->foreign_price_extra_child;
            $model->from_date = $request->from_date;
            $model->to_date = $request->to_date;
            $model->base_rate_id = $request->base_rate;
            $model->status = $request->status;
            $model->type = $request->plan_type;
            $model->save();
            DB::commit();
            return redirect()->route('rates.index');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = Rate::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

            return redirect()->route('rates.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('rates.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->ids);
        try {
         
            Rate::whereIn('id', $request->ids)->delete();

            return redirect()->route('rates.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('rates.index');
        }
    }
  
 
}
