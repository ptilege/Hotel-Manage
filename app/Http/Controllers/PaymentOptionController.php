<?php

namespace App\Http\Controllers;

use App\Models\PaymentOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;

class PaymentOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('PaymentOptions/Index');
    }

    public function getData()
    {
        $data = PaymentOption::all();

        return DataTables::of($data)
            ->addColumn('check', function ($row) {
                return '<div class="custom-control custom-checkbox item-check">
            <input type="checkbox" class="form-check-input" id="' . $row->id . '" value="' . $row->id . '">
            <label class="form-check-label form-check-label" for="' . $row->id . '"></label>
          </div>';
            })
            ->addColumn('action',  function ($row) {
                $action_html = '';
                if (auth()->user()->can('payment-options.view') && auth()->user()->can('payment-options.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('payment-options.edit')) {
                $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('payment-options.delete')) {
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
            ->addColumn('description', function ($row) {
                return substr($row->description, 0, 50)."...";
            })
            ->addColumn('is_test_mode', function ($row) {
                if ($row->is_test_mode == 1) {
                    return '<span class="badge bg-warning">Sandbox</span>';
                } else if($row->is_test_mode == 0){
                    return '<span class="badge bg-primary">Live</span>';
                }
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-warning">Inactive</span>';
                }
            })
            ->rawColumns(['check', 'action','is_test_mode', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = [
            ['id'=>'bank-transfer', 'name'=>'Bank Transfer'],
            ['id'=>'pay-here', 'name'=>'PayHere'],
        ];
        return Inertia::render('PaymentOptions/CreateUpdate', compact('options'));
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
            'name' => ['required', 'unique:payment_options,name'],
            'option' => ['required', 'unique:payment_options,name'],
            'description' => ['nullable'],
            'key' => ['nullable'],
            'secret' => ['nullable'],
            'mode' => ['nullable'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = new PaymentOption();
            $model->name = $request->name;
            $model->option = $request->option;
            $model->description = $request->description;
            $model->key = $request->key;
            $model->secret = $request->secret;
            $model->is_test_mode = $request->mode??0;
            $model->status = $request->status;
            $model->save();
            DB::commit();
            return redirect(route('payment-options.index'));
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            Log::error($e);
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentOption $paymentOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentOption = PaymentOption::find($id);
        return Inertia::render('PaymentOptions/CreateUpdate', ['paymentOption'=>$paymentOption]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:payment_options,name,'.$request->id],
            'description' => ['nullable'],
            'key' => ['required'],
            'secret' => ['required'],
            'mode' => ['required'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = PaymentOption::find($request->id);
            $model->name = $request->name;
            $model->description = $request->description;
            $model->key = $request->key;
            $model->secret = $request->secret;
            $model->is_test_mode = $request->mode;
            $model->status = $request->status;
            $model->save();
            DB::commit();
            return redirect(route('payment-options.index'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            abort(500);
        }
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = PaymentOption::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

                return redirect()->route('payment-options.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            PaymentOption::destroy([$request->ids]);
            return redirect()->route('payment-options.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }
}
