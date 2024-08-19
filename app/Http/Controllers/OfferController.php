<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Property;
use App\Models\Rate;
use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Offers/Index');
    }

    public function getData()
    {               
        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $data = Property::findOrFail($backendProperty->id)->offers()->get();
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
                if (auth()->user()->can('offers.view') && auth()->user()->can('offers.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('offers.edit')) {
                $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('offers.delete')) {
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
            ->addColumn('type', function ($row) {
                if ($row->type == 1) {
                    return 'Normal Discount';
                } else if ($row->type == 2) {
                    return 'Early Bird';
                } else if ($row->type == 3) {
                    return 'Free Nights';
                } else if ($row->type == 4) {
                    return 'Special Price for Weekends';
                } else if ($row->type == 5) {
                    return 'Weekdays Offers';
                }   
            })
            ->addColumn('date', function ($row) {
                return $row->from_date.' to '.$row->to_date;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-warning">Inactive</span>';
                }
            })
            ->rawColumns(['check', 'action', 'status', 'type', 'date'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room_types = [];
        $mealTypes = [];
        $bedTypes = [];
        $baseRates = [];

        $types = [
            ['id'=>1, 'name'=>"Normal Discount"],
            ['id'=>2, 'name'=>"Early Bird"],
            ['id'=>3, 'name'=>"Free Nights"],
            ['id'=>4, 'name'=>"Special Price for Weekends"],
            ['id'=>5, 'name'=>"Weekdays Offers"],
        ];
        
        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $room_types = Property::findOrFail($backendProperty->id)->rooms()->get();
            $mealTypes = Property::findOrFail($backendProperty->id)->mealTypes()->get();
            $bedTypes = Property::findOrFail($backendProperty->id)->bedTypes()->get();
            $baseRates = Rate::where(['type'=>'base', 'status'=>1])->get();
        }
        
        return Inertia::render('Offers/CreateUpdate', ['types'=>$types, 'room_types'=>$room_types, 'mealTypes'=>$mealTypes, 'bedTypes'=>$bedTypes, 'baseRates'=>$baseRates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'offer_type' => ['required'],
            'name' => ['required'],
            'description' => ['nullable'],
            'room_type' => ['required'],
            'meal_type' => ['required'],
            'bed_type' => ['required'],
            'status' => ['required'],
            'is_featured' => ['required'],
            'code' => ['nullable'],
            'max' => ['nullable', 'numeric'],
            'base_rate' => ['required'],
            'rate_type' => ['required'],
            'local_price' => ['nullable'],
            'foreign_price' => ['nullable'],
            'from_date' => ['required'],
            'to_date' => ['required'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:10000']
        ]);
        // dd($request);

        try {
            $backendProperty = PropertyController::getBackendProperty();
            if($backendProperty ){
                $propertyId = $backendProperty->id;
            } else {
                $propertyId = 0;
            }

            DB::beginTransaction();
            $offer = new Offer();
            $offer->type = $request->offer_type;
            $offer->name = $request->name;
            $offer->description = $request->description;
            $offer->room_type_id = json_encode($request->room_type);
            $offer->meal_type_id = json_encode($request->meal_type);
            $offer->bed_type_id = json_encode($request->bed_type);
            $offer->rate_id= $request->base_rate;
            $offer->rate_type = $request->rate_type;
            $offer->local_price = $request->local_price;
            $offer->foreign_price = $request->foreign_price;
            $offer->from_date = $request->from_date;
            $offer->to_date = $request->to_date;
            $offer->offer_code = $request->code;
            $offer->max_usage = $request->max;
            $offer->is_featured = $request->is_featured;
            $offer->property_id = $propertyId;
            $offer->status = $request->status;
            $offer->save();

            DB::commit();

            // $offer->mealTypes()->sync($request->meal_type);
            // $offer->bedTypes()->sync($request->bed_type);

            if ($request->hasFile('image')) {
                $offer->addMedia($request->file('image'))->toMediaCollection('Offer');
                $offer->save();
            }
            
            return redirect()->route('offer.index');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offer::find($id);
        
            $room_types = [];
            $mealTypes = [];
            $bedTypes = [];
            $baseRates = [];
    
            $types = [
                ['id'=>1, 'name'=>"Normal Discount"],
                ['id'=>2, 'name'=>"Early Bird"],
                ['id'=>3, 'name'=>"Free Nights"],
                ['id'=>4, 'name'=>"Special Price for Weekends"],
                ['id'=>5, 'name'=>"Weekdays Offers"],
            ];
            
            $backendProperty = PropertyController::getBackendProperty();
            if($backendProperty ){
                $room_types = Property::findOrFail($backendProperty->id)->rooms()->get();
                $mealTypes = Property::findOrFail($backendProperty->id)->mealTypes()->get();
                $bedTypes = Property::findOrFail($backendProperty->id)->bedTypes()->get();
                $baseRates = Rate::where(['type'=>'base', 'status'=>1])->get();
            }
            
            return Inertia::render('Offers/CreateUpdate', ['types'=>$types, 'room_types'=>$room_types, 'mealTypes'=>$mealTypes, 'bedTypes'=>$bedTypes, 'baseRates'=>$baseRates, 'offer'=>$offer]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'offer_type' => ['required'],
            'name' => ['required'],
            'description' => ['nullable'],
            'room_type' => ['required'],
            'meal_type' => ['required'],
            'bed_type' => ['required'],
            'status' => ['required'],
            'is_featured' => ['required'],
            'code' => ['nullable'],
            'max' => ['nullable', 'numeric'],
            'base_rate' => ['required'],
            'rate_type' => ['required'],
            'local_price' => ['nullable'],
            'foreign_price' => ['nullable'],
            'from_date' => ['required'],
            'to_date' => ['required'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:10000']
        ]);
        // dd($request);
        

        try {

            DB::beginTransaction();
            $offer = Offer::find($request->id);
            $offer->type = $request->offer_type;
            $offer->name = $request->name;
            $offer->description = $request->description;
            $offer->room_type_id = json_encode($request->room_type);
            $offer->meal_type_id = json_encode($request->meal_type);
            $offer->bed_type_id = json_encode($request->bed_type);
            $offer->rate_id= $request->base_rate;
            $offer->rate_type = $request->rate_type;
            $offer->local_price = $request->local_price;
            $offer->foreign_price = $request->foreign_price;
            $offer->from_date = $request->from_date;
            $offer->to_date = $request->to_date;
            $offer->offer_code = $request->code;
            $offer->max_usage = $request->max;
            $offer->is_featured = $request->is_featured;
            $offer->status = $request->status;
            $offer->save();

            DB::commit();

            // $offer->mealTypes()->sync($request->meal_type);
            // $offer->bedTypes()->sync($request->bed_type);

            if ($request->hasFile('image')) {
                count($offer->getMedia('Offer'))>0 ? $offer->getMedia('Offer')[0]->delete():null;
                $offer->addMedia($request->file('image'))->toMediaCollection('Offer');
                $offer->save();
            }
            
            return redirect()->route('offer.index');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            return abort(500);
        }
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $offer = Offer::find($request->id);
            if ($request->status == 0) {
                $offer->status = 1;
            } else {
                $offer->status = 0;
            }
            $offer->save();

            return redirect()->route('offer.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('offer.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Offer::destroy([$request->ids]);
            return redirect()->route('offer.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('offer.index');
        }
    }
}
