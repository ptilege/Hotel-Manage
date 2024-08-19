<?php

namespace App\Http\Controllers;

use App\Models\MealType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class MealTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('MealType/Index');
    }

    public function getData()
    {
        $data = MealType::all();

        return DataTables::of($data)
            ->addColumn('check', function ($row) {
                return '<div class="custom-control custom-checkbox item-check">
            <input type="checkbox" class="form-check-input" id="' . $row->id . '" value="' . $row->id . '">
            <label class="form-check-label form-check-label" for="' . $row->id . '"></label>
          </div>';
            })
            ->addColumn('action',  function ($row) {
                $action_html = '';
                if (auth()->user()->can('foodtype.view') && auth()->user()->can('foodtype.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('foodtype.edit')) {
                $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('foodtype.delete')) {
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('MealType/CreateUpdate');
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
                'description' => ['nullable'],
                'status' => ['required'],
            ]);
    
            try {
                DB::beginTransaction();
                $model = new MealType();
                $model->name = $request->name;
                $model->description = $request->description;
                $model->status = $request->status;
                $model->save();
                DB::commit();
                return redirect(route('meal.types.index'));
            } catch (Exception $e) {
                // dd($e);
                DB::rollBack();
                Log::error($e);
                return redirect(route('meal.types.index'));
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MealType  $mealType
     * @return \Illuminate\Http\Response
     */
    public function show(MealType $mealType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MealType  $mealType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MealType::find($id);
        return Inertia::render('MealType/CreateUpdate', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodType  $foodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:meal_types,name,'.$request->id],
            'description' => ['nullable'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = MealType::find($request->id);
            $model->name = $request->name;
            $model->description = $request->description;
            $model->status = $request->status;
            $model->save();
            DB::commit();
            return redirect(route('meal.types.index'));
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e);
            return redirect(route('meal.types.index'));
        }
    }


    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = MealType::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

                return redirect()->route('meal.types.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('meal.types.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodType  $foodType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request);
        try {
            MealType::destroy([$request->ids]);
            return redirect()->route('meal.types.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('meal.types.index');
        }
    }

        // ***************************************************************
        public function propertyMealTypeIndex()
        {
            $backendProperty = PropertyController::getBackendProperty();
            if($backendProperty) {
                $data = $backendProperty->mealTypes()->get();
            } else {
                $data = null;
            }
            $mealTypes = MealType::all();
            return Inertia::render('MealType/CreateUpdateForProperty', compact('data','mealTypes'));
        }
    
        public function propertyMealTypeUpdate(Request $request) {
            $request->validate([
                'mealTypes.*.type'=>'required',
                'mealTypes.*.status'=>'required'
            ],[
                'mealTypes.*.type.required' => 'This field is required',
                'mealTypes.*.status.required' => 'This field is required',
            ]);
    
            $backendProperty = PropertyController::getBackendProperty();
            if($backendProperty) {
                $temp = [];
                if($request->has('mealTypes') && $request->mealTypes) {
                    foreach ($request->mealTypes as $key => $value) {
                        $temp[$value['type']]['status'] = $value['status'];
                    }
                }
                // dd($temp);
                $backendProperty->mealTypes()->sync($temp);
                return redirect()->back();
            } else {
                abort(500);
            }
        }
}
