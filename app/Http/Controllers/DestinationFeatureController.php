<?php

namespace App\Http\Controllers;

use App\Models\DestinationFeature;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DestinationFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('DestinationFeature/Index');
    }

    public function getData()
    {
        $data = DestinationFeature::all();

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
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-warning">Inactive</span>';
                }
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
        return Inertia::render('DestinationFeature/CreateUpdate');
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
            'name' => ['required','unique:destination_features,name'],
            'status' => ['required'],
        ]);

        // dd($request);
        try {
            DB::beginTransaction();
            $model = new DestinationFeature();
            $model->name = $request->name;
            $model->status = $request->status;
            $model->save();

            DB::commit();

            return redirect(route('destination.features.index'));
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            Log::error($ex);
            return redirect(route('destination.features.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DestinationFeature  $Destination
     * @return \Illuminate\Http\Response
     */
    public function show(DestinationFeature $Destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DestinationFeature  $Destination
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DestinationFeature::find($id);
        return Inertia::render('DestinationFeature/CreateUpdate', compact('data'));
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
            'name' => ['required', 'unique:destination_features,name,'.$request->id],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = DestinationFeature::find($request->id);
            $model->name = $request->name;
            $model->status = $request->status;
            $model->save();

            DB::commit();

            return redirect(route('destination.features.index'));
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            Log::error($ex);
            return redirect(route('destination.features.index'));
        }
    }


    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = DestinationFeature::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

            return redirect()->route('destination.features.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('destination.features.index');
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
            DestinationFeature::destroy([$request->ids]);
            return redirect()->route('destination.features.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->route('destination.features.index');
        }
    }
}
