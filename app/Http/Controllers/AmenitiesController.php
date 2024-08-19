<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\File;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $properties = Property::where(['status'=>1])->get();
        return Inertia::render('Amenities/Index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        // $propertyId = $request->property;
        // $authUser = User::find(auth()->id());
        // if($authUser->hasRole('Super Admin')) {
        //     if($request->property) {
        //         $data = Amenity::whereHas('properties', function ($query) use ($propertyId) {
        //             $query->where('property_id', $propertyId);
        //         })->get();;          
        //     } else {
        //         $data = Amenity::all();
        //     }
        // } else {
        //     // $data = Amenity::all();
        // }
        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $data = Amenity::where(['property_id'=>$backendProperty->id])->get();
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
                if (auth()->user()->can('amenities.view') && auth()->user()->can('amenities.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('amenities.edit')) {
                $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('amenities.delete')) {
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
            })->addColumn('is_amount', function ($row) {
                if ($row->is_amount == 1) {
                    return '<span class="badge bg-primary">Amount</span>';
                } else if($row->is_amount == 0) {
                    return '<span class="badge bg-dark">Percentage</span>';
                }
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-warning">Inactive</span>';
                }
            })
            ->rawColumns(['check', 'action', 'is_amount', 'status'])
            ->make(true);
    }
    public function create()
    {
        $iconData = File::get('fa-icons.json');

        $icons = json_decode($iconData);
    
        return Inertia::render('Amenities/CreateUpdate',compact('icons'));
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
            'name' => ['required'],
            'icon' => ['required'],
            'status' => ['required'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:10000'],
        ]);

        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $propertyId = $backendProperty->id;
        } else {
            $propertyId = 0;
        }

        try {
            DB::beginTransaction();
            $model = new Amenity();
            $model->name = $request->name;
            $model->icon = $request->icon;
            $model->property_id = $propertyId;
            $model->status = $request->status;
            $model->save();
            if ($request->hasFile('image')) {
                $model->addMedia($request->file('image'))->toMediaCollection('amenities');
                $model->save();
            }
            DB::commit();
            return redirect(route('amenities.index'));
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e);
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenities
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity  $amenities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $iconData = File::get('fa-icons.json');
        $icons = json_decode($iconData);
        $amenities = Amenity::with('media')->find($id);
        // dd($amenities);
        return Inertia::render('Amenities/CreateUpdate', ['amenities'=>$amenities,'icons'=>$icons]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amenity  $amenities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->id);
        $request->validate([
            'name' => ['required'],
            'icon' => ['required'],
            'status' => ['required'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:10000'],
        ]);

        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $propertyId = $backendProperty->id;
        } else {
            $propertyId = 0;
        }

        try {

            DB::beginTransaction();
            // $model = new Amenity();
            $model = Amenity::where('id', $request->id)->first();
     
            $model->name = $request->name;
            $model->icon = $request->icon;
            $model->property_id = $propertyId;
            $model->status = $request->status;
            $model->save();
            if ($request->hasFile('image')) {
                count($model->getMedia('amenities'))>0 ? $model->getMedia('amenities')[0]->delete():null;
                $model->addMedia($request->file('image'))->toMediaCollection('amenities');
                $model->save();
            }
            DB::commit();
            return redirect(route('amenities.index'));
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e);
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenities  $amenities
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = Amenity::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

                return redirect()->route('amenities.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('amenities.index');
        }
    }

    public function destroy(Request $request)
    {
        // dd($request);
        try {
            Amenity::destroy([$request->ids]);
            return redirect()->route('amenities.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('amenities.index');
        }
    }
}
