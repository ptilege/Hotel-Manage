<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Amenity;
use App\Models\Destination;
use App\Models\Property;
use App\Models\Currency;
use App\Models\PropertyType;
use App\Models\Partner;
use App\Models\Settings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Services\Beds24Service\Beds24Service;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Properties/Index');
    }
    public function getData()
    {
        $user = Auth::user();
        $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;

        if ($roleType == 'admin') {
            $data = Property::with('propertyType')->get();
        } else if ($roleType == 'property') {
            $data = $user->properties()->with('propertyType')->get();
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
                if (auth()->user()->can('property.view') && auth()->user()->can('property.edit')) {
                    $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('property.edit')) {
                    $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('property.delete')) {
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
            })->addColumn('type', function ($row) {
                return $row->propertyType->name ?? '';
            })
            ->addColumn('partner', function ($row) {
                return $row->partner? $row->partner->name : 'No Partner';
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
        $types = PropertyType::where(['status' => 1])->get();
        $destinations = Destination::where(['status' => 1])->get();
        $amenities = Amenity::where(['status' => 1])->get();
        $partners = Partner::where(['status' => 1])->get();
        $p = new Partner();
        $p->id = '0';
        $p->name = '-- Select Partner --';
        $partners = $partners->prepend($p);

        return Inertia::render('Properties/CreateUpdate', compact('types', 'destinations', 'amenities', 'partners'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Beds24Service $beds24Service)
    {
        $request->validate([
            'name' => ['required', 'unique:properties,name'],
            'slug' => ['required', 'unique:properties,slug'],
            'description' => ['nullable'],
            'video' => ['nullable'],
            'stars' => ['nullable'],
            'type' => ['required'],
            'destination' => ['required'],
            'amenities' => ['nullable', 'array'],
            'partner_id' => ['nullable'],
            'asigned_users' => ['nullable', 'array'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $model = new Property();
            $model->name = $request->name;
            $model->slug = $request->slug;
            $model->description = $request->description;
            $model->video_url = $request->video;
            $model->stars = $request->stars;
            $model->property_type_id = $request->type;
            $model->destination_id = $request->destination;
            $model->partner_id = $request->partner_id;
            $model->status = $request->status;
            $model->save();
            $model->amenities()->sync($request->amenities);

        if ($request->hasFile('image')) {
            $model->addMedia($request->file('image'))->toMediaCollection('Property');
            $model->save();
        }

        DB::commit();

        $beds24Data = [
            'name' => $model->name,
            'property_id' => $model->property_id,
            'type' => $model->property_type_id,
            'room_id' => $model->room_id,
            'bed_type_id' => $model->bed_type_id,
            'meal_type_id' => $model->meal_type_id,
            'price' => $model->price,
            'from_date' => $model->from_date,
            'to_date' => $model->to_date,
        ];

        
        $beds24Response = $beds24Service->createProperties($beds24Data);
        Log::info('Beds24Response in controller: ' . print_r($beds24Response, true));
        return redirect(route('properties.index'));
    } catch (Exception $e) {
        DB::rollBack();
        Log::error($e);
        abort(500);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Property::with('amenities', 'media', 'currencies')->find($id);
        $types = PropertyType::where(['status' => 1])->get();
        $destinations = Destination::where(['status' => 1])->get();
        $amenities = Amenity::where(['status' => 1])->get();
        $partners = Partner::where(['status' => 1])->get();
        $currencies = Currency::where(['status' => 1])->get();
        $p = new Partner();
        $p->id = '0';
        $p->name = '-- Select Partner --';
        $partners = $partners->prepend($p);
        // dd($data);
        return Inertia::render('Properties/CreateUpdate', compact('data', 'types', 'destinations', 'amenities', 'partners','currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:properties,name,' . $request->id],
            'slug' => ['required', 'unique:properties,slug,' . $request->id],
            'description' => ['nullable'],
            'type' => ['required'],
            'destination' => ['required'],
            'amenities' => ['nullable', 'array'],
            'asigned_users' => ['nullable', 'array'],
            'status' => ['required'],
            'partner_id' =>['nullable'],
            'map_location' => ['nullable'],
            'base_currency' =>['nullable','different:secondary_currency'],
            'secondary_currency' =>['nullable','different:base_currency'],
        ]);
        // dd($request->all());
        try {
            DB::beginTransaction();

            $model = Property::find($request->id);
            $model->name = $request->name;
            $model->slug = $request->slug;
            $model->description = $request->description;
            $model->video_url = $request->video;
            $model->stars = $request->stars;
            $model->property_type_id = $request->type;
            $model->destination_id = $request->destination;
            $model->status = $request->status;

            $model->email = $request->email;
            $model->contact_1 = $request->contact_no;
            $model->contact_2 = $request->contact_2;
            $model->address_1 = $request->address;
            $model->address_2 = $request->address_2;
            // $model->country_id = $request->country;
            $model->country_id = 195;
            $model->fax = $request->fax;
            $model->map_location = $request->map_location;

            $model->partial_pay_type = $request->partial_pay_type;
            $model->partial_pay_amount = $request->partial_pay;
            $model->partner_id = $request->partner_id;
            $model->hotel_policy = $request->policy;
            $model->save();

            DB::commit();

            $model->amenities()->sync($request->amenities);
            // $model->partners()->sync($request->partners);

            if($request->base_currency) {
                $bc = [$request->base_currency=>['default'=>true]];
                if($request->secondary_currency) {
                    // $sc = [$request->secondary_currency=>['default'=>false]];
                    $bc[$request->secondary_currency] = ['default'=>false];
                    // array_push($bc, $request->secondary_currency=>['default'=>false])
                }
                // $c = array_merge([$bc, $sc]);
                // dd($bc);
                $model->currencies()->sync($bc);
            }
            
            if ($request->hasFile('image')) {
                count($model->getMedia('Property')) > 0 ? $model->getMedia('Property')[0]->delete() : null;
                $model->addMedia($request->file('image'))->toMediaCollection('Property');
                $model->save();
            }
           
            return redirect(route('properties.index'));
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
            $user = Property::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

            return redirect()->route('properties.index');
        } catch (Exception $ex) {
            Log::error($ex);
            // return abort(500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Property::destroy([$request->ids]);
            return redirect()->route('properties.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }

    public function uploadGalleryImages(Request $request)
    {

        $model = Property::find($request->id);
        $folderName = Str::slug($model->name);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $model->addMedia($file)->withCustomProperties(['category' => $request->title])->toMediaCollection($folderName);
                $model->save();
            }
        } else if ($request->has('gallery')) {
            foreach ($request->gallery as $file) {
                if (array_key_exists("images", $file)) {
                    $title = $file['title'];
                    foreach ($file['images'] as $image) {
                        $model->addMedia($image)->withCustomProperties(['category' => $title])->toMediaCollection($folderName);
                        $model->save();
                    }
                }
            }
        }
        return redirect()->route('properties.edit', $request->id);
    }
    public function deleteGalleryImage($id, Request $request)
    {
        $model = Media::find($id);
        $model->delete();
        return redirect()->back();
    }

    public function setBackendProperty(Request $request)
    {
        $request->session()->put('backend_property_id', $request->id);
        // dd(session()->all());
        return redirect()->back();
    }

    public static function getBackendProperty()
    {
        if (session()->has('backend_property_id')) {
            $propertyId = session('backend_property_id');
            $property = Property::find($propertyId);
        } else {
            $property = null;
        }
        return $property;
    }

    public static function getPropertiesByUserAndRole()
    {
        $user = Auth::user();
        $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;

        if ($roleType == 'admin') {
            return Property::all();
        } else if ($roleType == 'property') {
            return $user->properties;
        }
    }

    public function defaultPolicy()
    {
        $data = Settings::where(['key' => 'default_privacy_policy'])->first();
        return Inertia::render('Policy/CreateUpdate', compact('data'));
    }

    public function defaultPolicyUpdate(Request $request)
    {
        // dd($request);
        try {
            $model = Settings::where(['key' => 'default_privacy_policy'])->first();
            $model->value = $request->policy;
            $model->save();
            return redirect()->route('property.policy.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
        // return Inertia::render('Policy/CreateUpdate');
    }
}
