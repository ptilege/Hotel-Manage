<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\DestinationFeature;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Destinations/Index');
    }

    public function getData()
    {
        $data = Destination::all();

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
                } else if ($row->is_amount == 0) {
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
        $activities = Activity::where(['status'=>1])->get();
        $features = DestinationFeature::where(['status'=>1])->get();
        return Inertia::render('Destinations/CreateUpdate', compact('activities', 'features'));
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
            'slug' => ['required', 'unique:property_types,slug'],
            'description' => ['nullable'],
            'image' => ['nullable'],
            'activities' => ['nullable', 'array'],
            'features' => ['nullable', 'array'],
            'status' => ['required'],
        ]);

        // dd($request);
        try {
            DB::beginTransaction();
            $model = new Destination();
            $model->name = $request->name;
            $model->slug = $request->slug;
            $model->description = $request->description;
            $model->status = $request->status;
            $model->save();

            DB::commit();
            
            $model->activities()->sync($request->activities);
            $model->destinationFeatures()->sync($request->features);

            if ($request->hasFile('image')) {
                $model->addMedia($request->file('image'))->toMediaCollection('Destination');
                $model->save();
            }

            return redirect(route('destinations.index'));
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            Log::error($ex);
            return redirect(route('destinations.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $Destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $Destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $Destination
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Destination::with('activities', 'destinationFeatures')->find($id);
        $activities = Activity::where(['status'=>1])->get();
        $features = DestinationFeature::where(['status'=>1])->get();
        return Inertia::render('Destinations/CreateUpdate', compact('data','activities', 'features'));
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
            'name' => ['required'],
            'slug' => ['required', 'unique:property_types,slug,'.$request->id],
            'description' => ['nullable'],
            'image' => ['nullable'],
            'activities' => ['nullable', 'array'],
            'features' => ['nullable', 'array'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = Destination::find($request->id);
            $model->name = $request->name;
            $model->slug = $request->slug;
            $model->description = $request->description;
            $model->status = $request->status;
            $model->save();

            DB::commit();
            
            $model->activities()->sync($request->activities);
            $model->destinationFeatures()->sync($request->features);

            if ($request->hasFile('image')) {
                count($model->getMedia('Destination'))>0 ? $model->getMedia('Destination')[0]->delete():null;
                $model->addMedia($request->file('image'))->toMediaCollection('Destination');
                $model->save();
            }

            return redirect(route('destinations.index'));
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            Log::error($ex);
            return redirect(route('destinations.index'));
        }
    }


    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = Destination::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

            return redirect()->route('destinations.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('destinations.index');
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
            Destination::destroy([$request->ids]);
            return redirect()->route('destinations.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('destinations.index');
        }
    }
}
