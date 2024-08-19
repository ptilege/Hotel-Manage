<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Partner;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::all();
        return Inertia::render('Career/Index', compact('careers'));
    }


    public function getData()
    {
        $data = Career::all();
        // dd($data);

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
            ->rawColumns(['check', 'action', 'status', 'logo'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Career/CreateUpdate');
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
             
                'title' => ['required'],
                'location' => ['required'],
                'job_description' => ['required'],
                'about_role' => ['required'],
                'about_you' => ['required'],
                'iframe_link' => ['required'],
                'status' => ['required'],
            ]);
    
            try {
                DB::beginTransaction();
                $model = new Career();
                $model->title = $request->title;
                $model->location = $request->location;
                $model->job_description = $request->job_description;
                $model->about_role = $request->about_role;
                $model->about_you = $request->about_you;
                $model->iframe_link = $request->iframe_link;
                $model->status = $request->status;
                $model->save();
                DB::commit();

              
                return redirect(route('careers.index'));
            } catch (Exception $e) {
                // dd($e);
                DB::rollBack();
                Log::error($e);
                return redirect(route('careers.index'));
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $Partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $Partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $Partner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Career::find($id);
        return Inertia::render('Career/CreateUpdate', ['data'=>$data]);
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
            'title' => ['required'],
            'location' => ['required'],
            'job_description' => ['required'],
            'about_role' => ['required'],
            'about_you' => ['required'],
            'iframe_link' => ['required'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = Career::find($request->id);
            $model->title = $request->title;
            $model->location = $request->location;
            $model->job_description = $request->job_description;
            $model->about_role = $request->about_role;
            $model->about_you = $request->about_you;
            $model->iframe_link = $request->iframe_link;
            $model->status = $request->status;
            $model->save();
            DB::commit();
          

            return redirect(route('careers.index'));
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e);
            return redirect(route('careers.index'));
        }
    }


    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = Career::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

            return redirect(route('careers.index'));
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect(route('careers.index'));
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
            Career::destroy([$request->ids]);
            return redirect(route('careers.index'));
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect(route('careers.index'));
        }
    }

}
