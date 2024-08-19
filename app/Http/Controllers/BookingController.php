<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Bookings/Index');
    }

    public function getData()
    {
        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $data = Property::findOrFail($backendProperty->id)->bookings()->get();
        } else {
            $user = Auth::user();
            $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;
    
            if ($roleType == 'admin') {
                $data = Booking::all();
            } else if ($roleType == 'property') {
                $ids = $user->properties()->pluck('id');
                $data = Booking::whereIn('id', $ids)->get();
            }
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
                if (auth()->user()->can('currency.view') && auth()->user()->can('currency.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                return '<div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="min-width: 10rem;">
                                ' . $action_html . '
                                </div>
                            </div>';
            })
            ->addColumn('customer', function ($row) {
                return $row->first_name . ' ' . $row->last_name;
            })
            ->addColumn('inv_id', function ($row) {
                return 'INV-'.$row->id;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'confirm') {
                    return '<span class="badge bg-success">Confirmed</span>';
                } else if($row->status == 'cancel') {
                    return '<span class="badge bg-danger">Cancled</span>';
                } else if($row->status == 'pending') {
                    return '<span class="badge bg-primary">Pending</span>';
                } else {
                    return '<span class="badge bg-danger">Failed</span>';
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
        return Inertia::render('Bookings/CreateUpdate');
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
            'name' => ['required', 'unique:currencies,name'],
            'symbol' => ['required'],
            'decimal_places' => ['required'],
            'symbol_pos' => ['required'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = new Booking();
            $model->name = $request->name;
            $model->symbol = $request->symbol;
            $model->decimal_places = $request->decimal_places;
            $model->symbol_pos = $request->symbol_pos;
            $model->status = $request->status;
            $model->save();
            DB::commit();
            return redirect(route('booking.index'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::find($id);
        return Inertia::render('Bookings/CreateUpdate', ['booking'=>$booking]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:currencies,name,'.$request->id],
            'symbol' => ['required'],
            'decimal_places' => ['required'],
            'symbol_pos' => ['required'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $model = Booking::find($request->id);
            $model->name = $request->name;
            $model->symbol = $request->symbol;
            $model->decimal_places = $request->decimal_places;
            $model->symbol_pos = $request->symbol_pos;
            $model->status = $request->status;
            $model->save();
            DB::commit();
            return redirect(route('currency.index'));
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
            $user = Booking::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

                return redirect()->route('booking.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Booking::destroy([$request->ids]);
            return redirect()->route('booking.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }
}
