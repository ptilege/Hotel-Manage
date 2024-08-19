<?php

namespace App\Http\Controllers;

use App\Models\FrontendUser;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;

class FrontendUserController extends Controller
{
    public $bookingNumber;
    public $bookingStatus;
    public $slug;
    protected $bookingData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('FrontendUsers/Index');
    }

    public function getData()
    {
        $users = FrontendUser::all();

        return DataTables::of($users)
            ->addColumn('check', function ($row) {
                return '<div class="custom-control custom-checkbox item-check">
            <input type="checkbox" class="form-check-input" id="' . $row->id . '" value="' . $row->id . '">
            <label class="form-check-label form-check-label" for="' . $row->id . '"></label>
          </div>';
            })
            ->addColumn('action',  function ($row) {

                $action_html = '';
                if (auth()->user()->can('frontend-user.view frontend-user.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('frontend-user.edit')) {
                $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('frontend-user.create')) {
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
            })->addColumn('status', function ($row) {
                if ($row->status == 1 && !$row->deleted_at) {
                    return '<span class="badge bg-success">Active</span>';
                } else if ($row->status == 0 && !$row->deleted_at) {
                    return '<span class="badge bg-warning">Inactive</span>';
                } else if($row->deleted_at) {
                    return '<span class="badge bg-danger">Suspended</span>';
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
        return Inertia::render('FrontendUsers/CreateUpdate');
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
            'email' => ['required', 'unique:frontend_users,email'],
            'phone' => ['nullable', 'unique:frontend_users,phone'],
            'password' => ['required', 'confirmed'],
            'avatar' => ['nullable', 'mimes:jpeg,jpg,png, webp', 'max:10000']
        ]);

        // dd($request->all());

        try {
            DB::beginTransaction();

            $user = new FrontendUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = 1;
            $user->save();

            DB::commit();

            if ($request->hasFile('avatar')) {
                $file = $user->addMedia($request->file('avatar'))->toMediaCollection('front user');
                $user->avatar = str_replace(config('app.url'), '', $file->getUrl());
                $user->save();
            }

            return redirect()->route('settings.front-user');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrontendUser  $frontendUser
     * @return \Illuminate\Http\Response
     */
    public function show(FrontendUser $frontendUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FrontendUser  $frontendUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $frontendUser = FrontendUser::find($id);
        return Inertia::render('FrontendUsers/CreateUpdate', ['frontendUser'=>$frontendUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrontendUser  $frontendUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:frontend_users,email,'.$request->id],
            'phone' => ['nullable', 'unique:frontend_users,phone,'.$request->id],
            'avatar' => ['nullable', 'mimes:jpeg,jpg,png, webp', 'max:10000']
        ]);

        // dd($request->all());

        try {
            
            DB::beginTransaction();
            
            $user = FrontendUser::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->avatar = $request->avatar;
            

            DB::commit();

            // if ($request->hasFile('avatar')) {
            //     $file = $user->addMedia($request->file('avatar'))->toMediaCollection('front user');
            //     $user->avatar = str_replace(config('app.url'), '', $file->getUrl());
            //     $user->save();
            // }
            if ($request->hasFile('avatar')) {
                // Save the file to the media collection
                $file = $user->addMedia($request->file('avatar'))->toMediaCollection('front user');
                dd($file);
                // Update the avatar field with the file URL
                $user->avatar = str_replace(config('app.url'), '', $file->getUrl());
            }
            $user->save();
            return redirect()->route('settings.front-user');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            return abort(500);
        }
    }

//     public function updatePassword(Request $request)
// {
//     $request->validate([
//         'password' => ['required', 'string', 'confirmed'],
//         'password_confirmation' => ['required', 'string'],
//     ]);

//     try {
//         $user = FrontendUser::find($request->id);

//         // Update the password
//         $user->password = Hash::make($request['password']);
//         $user->save();

//         return back()->with('success', 'Password updated successfully.');
//     } catch (Exception $ex) {
//         Log::error($ex);
//         return back()->with('error', 'Failed to update password.');
//     }
// }
public function updatePassword(Request $request)
{
    $request->validate([
        'password' => ['required', 'string', 'confirmed'],
        'password_confirmation' => ['required', 'string'],
    ]);

    try {
        Log::info('Attempting to update password.');

        $user = FrontendUser::find($request->id);

        if (!$user) {
            Log::error('User not found.');
            return back()->with('error', 'User not found.');
        }

        // Update the password
        $user->password = Hash::make($request['password']);
        $user->save();

        Log::info('Password updated successfully.');
        return back()->with('success', 'Password updated successfully.');
    } catch (Exception $ex) {
        Log::error('Error updating password: ' . $ex->getMessage());
        return back()->with('error', 'Failed to update password. Please try again.');
    }
}


    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = FrontendUser::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

            return redirect()->route('settings.front-user');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }

//     public function bookingHas()
// {
//     if(Auth::guard('customers')->check()){
//         // Get the property by slug
//         $property = Property::where('slug', $this->slug)->first();

//         // Check if the property exists
//         if ($property) {
//             $propertyId = $property->id;
//             $userEmail = auth('customers')->user()->email;
//             $bookingid = $this->bookingNumber;

//             // Find the booking for the authenticated user and the specified property
//             $booking = Booking::where([
//                 'status' => 'confirm',
//                 'property_id' => $propertyId,
//                 'id' => $bookingid,
//                 'email' => $userEmail
//             ])->first();

//             // Check if the booking exists
//             if ($booking) {
//                 // Booking found
//                 $this->bookingStatus = '1';
//                 $this->bookingData = $booking; // Save booking data for later use
//             } else {
//                 // No booking found
//                 $this->bookingStatus = '0';
//                 $this->bookingData = null;
//             }
//         } else {
//             // Property not found
//             $this->bookingStatus = '0';
//             $this->bookingData = null;
//         }
//     } else {
//         // User not authenticated
//         $this->bookingStatus = '0';
//         $this->bookingData = null;
//     }
// }
// public function __get($property)
//     {
//         // Implement the magic __get method to access dynamic properties
//         if (property_exists($this, $property)) {
//             return $this->$property;
//         }
//         return null;
//     }
//     public function updateStatus(Request $request, $id)
// {
//     try {
//         $user = Auth::user();
//         $booking = Booking::find($id);

//         // Check if the user has the specified booking and email
//         if ($booking && $user->email == $booking->email) {
//             if ($booking->status == 0) {
//                 $booking->status = 1;
//             } else {
//                 $booking->status = 0;
//             }

//             $booking->save();

//             return redirect()->route('settings.front-user')->with('success', 'Booking status updated successfully');
//         } else {
//             return redirect()->route('settings.front-user')->with('error', 'Invalid booking ID or email');
//         }
//     } catch (Exception $ex) {
//         Log::error($ex);
//         return abort(500);
//     }
// }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrontendUser  $frontendUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->all());
        try {
            FrontendUser::destroy([$request->ids]);
            return redirect()->route('settings.front-user');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }

    public function validatePassword(Request $request, $user, $errorBag)
    {
        Validator::make($request->all(), [
            'confirm_password' => ['required', 'string'],
        ])->after(function ($validator) use ($request, $user) {
            if (!isset($request['confirm_password']) || !Hash::check($request['confirm_password'], $user->password)) {
                $validator->errors()->add('confirm_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag($errorBag);
    }


    
}
