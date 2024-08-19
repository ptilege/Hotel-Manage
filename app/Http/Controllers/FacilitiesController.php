<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Facilities;
use App\Models\FacilitiesProperty;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\File;

class FacilitiesController extends Controller{

    public function index(Request $request)
    {
        $properties = Property::where(['status'=>1])->get();
        return Inertia::render('Facilities/Index', compact('properties'));
    }

    public function getData(Request $request)
    {
      
        $backendProperty = PropertyController::getBackendProperty();
      
        if($backendProperty ){
            $data = Facilities::where(['property_id'=>$backendProperty->id])->orderBy('position')->get();
           
        } else {
            $data = collect([]);
        }

        return DataTables::of($data)
        ->addColumn('position', function ($row) {
            return '<div class="custom-control change-order" data-item-id="' . $row->id . '" data-position="' . $row->position . '"><i class="fas fa-bars"></i></div>';
        })
            ->addColumn('check', function ($row) {
                return '<div class="custom-control custom-checkbox item-check">
            <input type="checkbox" class="form-check-input" id="' . $row->id . '" value="' . $row->id . '">
            <label class="form-check-label form-check-label" for="' . $row->id . '"></label>
          </div>';
            })
            ->addColumn('action',  function ($row) {
                $action_html = '';
                if (auth()->user()->can('facilities.view') && auth()->user()->can('facilities.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('facilities.edit')) {
                $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('facilities.delete')) {
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
            ->rawColumns(['position','check', 'action', 'is_amount', 'status'])
            ->make(true);
    }
    public function create()
    {
          // Load data from icomoon-icons.json
        $icomoonData = File::get('icomoon-icons.json');
        $icomoonIcons = json_decode($icomoonData);

        // Load data from fa-icons.json
        $faData = File::get('fa-icons.json');
        $faIcons = json_decode($faData);

        $icons = array_merge($icomoonIcons, $faIcons);

        

        return Inertia::render('Facilities/CreateUpdate',compact('icons'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'icon' => ['required'],
            'sub_facilities' => ['required'],
            'status' => ['required'],
          
        ]);
        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $propertyId = $backendProperty->id;
        } else {
            $propertyId = 0;
        }

        try {
            DB::beginTransaction();
            $model = new Facilities();
            $model->name = $request->name;
            $model->icon = $request->icon;
            $model->sub_facilities = $request->sub_facilities;
            $model->property_id = $propertyId;
            $model->status = $request->status;
            // dd($model);
            $model->save();
            $facilitiesId = $model->id;

            // dd($facilitiesId);
            DB::commit();
           
            DB::beginTransaction();
            $model = new FacilitiesProperty();
            $model->property_id = $propertyId;
            $model->facilities_id = $facilitiesId;
            $model->save();
            DB::commit();
            return redirect(route('facilities.index'));
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e);
            abort(500);
        }
    }
    public function edit($id)
    {
        $icomoonData = File::get('icomoon-icons.json');
        $icomoonIcons = json_decode($icomoonData);

        // Load data from fa-icons.json
        $faData = File::get('fa-icons.json');
        $faIcons = json_decode($faData);

        $icons = array_merge($icomoonIcons, $faIcons);
        $facilities = Facilities::find($id);
        // dd($facilities);
        return Inertia::render('Facilities/CreateUpdate', ['facilities'=>$facilities,'icons'=>$icons]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'icon' => ['required'],
            'sub_facilities' => ['required'],
            'status' => ['required'],
        ]);

        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $propertyId = $backendProperty->id;
        } else {
            $propertyId = 0;
        }

        try {

            DB::beginTransaction();
            $model = Facilities::where('name', $request->name)->first();
            //  dd($model);
            $model->name = $request->name;
            $model->icon = $request->icon;
            $model->sub_facilities = $request->sub_facilities;
            $model->property_id = $propertyId;
            $model->status = $request->status;
            // dd($model);
            $model->save();
            // $facilitiesId = $model->id;

            // dd($facilitiesId);
            DB::commit();
           
            // DB::beginTransaction();
            // $model = new FacilitiesProperty();
            // $model->property_id = $propertyId;
            // $model->facilities_id = $facilitiesId;
            // $model->save();
            // DB::commit();
            return redirect(route('facilities.index'));
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e);
            abort(500);
        }
    }
    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = Facilities::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

                return redirect()->route('facilities.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('facilities.index');
        }
    }
    public function destroy(Request $request)
    {
        // dd($request);
        try {
            Facilities::destroy([$request->ids]);
            return redirect()->route('facilities.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('facilities.index');
        }
    }
    public function reorder(Request $request)
    {
        foreach($request->input('rows', []) as $row)
        {
            Facilities::find($row['id'])->update([
                'position' => $row['position']
            ]);
        }

        return redirect(route('facilities.index'));
    }
}