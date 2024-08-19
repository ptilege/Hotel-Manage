<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Rooms/Index');
    }

    public function getData()
    {
        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $data = Property::findOrFail($backendProperty->id)->rooms()->get();
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
                if (auth()->user()->can('room.view') && auth()->user()->can('room.edit')) {
                $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('room.edit')) {
                $action_html .= '<a class="dropdown-item ' . ($row->status == 1 ? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 1 ? ' Deactivate' : ' Activate') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('room.delete')) {
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
        $mealTypes =[];
        $bedTypes = [];
        $amenities = [];

        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $mealTypes = Property::findOrFail($backendProperty->id)->mealTypes()->get();
            $bedTypes = Property::findOrFail($backendProperty->id)->bedTypes()->get();
            $amenities = Amenity::where(['property_id'=>$backendProperty->id])->get();
        }
        return Inertia::render('Rooms/CreateUpdate', compact('mealTypes', 'bedTypes','amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required'],
            'quantity' => ['required'],
            'meal_type' => ['required','array','min:1'],
            'bed_type' => ['required', 'array','min:1'],
            'max_adults' => ['nullable', 'numeric'],
            'max_child' => ['nullable', 'numeric'],
            'max_extra_beds' => ['nullable', 'numeric'],
            'default_web' => ['nullable', 'numeric'],
            'policies' => ['nullable'],
            'amenitites' => ['nullable'],
            // 'image' => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:10000'],
          
           
        ]);

        try {
            $backendProperty = PropertyController::getBackendProperty();
            if($backendProperty ){
                $propertyId = $backendProperty->id;
            } else {
                $propertyId = 0;
            }

            DB::beginTransaction();
            $model = new Room();
            $model->room_no = 1;
            $model->channel_m_room_id = 16;
            $model->name = $request->name;
            $model->quantity = $request->quantity;
            $model->max_adults = $request->max_adults;
            $model->max_child= $request->max_child;
            $model->max_extra_beds = $request->max_extra_beds;
            $model->web_quantity = $request->default_web;
            $model->description = $request->description;
            $model->property_id = $propertyId;
            $model->status = 1;
            $model->save();

            DB::commit();

            $model->mealTypes()->sync($request->meal_type);
            $model->bedTypes()->sync($request->bed_type);

            // if ($request->hasFile('image')) {
            //     $model->addMedia($request->file('image'))->toMediaCollection('Room');
            //     $model->save();
            // }
            if ($request->has('featuredImages')) {
                $featuredImagesData = $request->featuredImages;
                // dd($featuredImagesData);
                if (isset($featuredImagesData['images']) && is_array($featuredImagesData['images'])) {
                    foreach ($featuredImagesData['images'] as $image) {
                        $model->addMedia($image)->toMediaCollection('Room');
                        $model->save();
                    }
                }
            }
            
        //   dd($model);
            return redirect()->route('room.index');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Room::with('mealTypes', 'bedTypes', 'media')->find($id);
        $mealTypes =[];
        $bedTypes = [];
        $amenities = [];

        $backendProperty = PropertyController::getBackendProperty();
        if($backendProperty ){
            $mealTypes = Property::findOrFail($backendProperty->id)->mealTypes()->get();
            $bedTypes = Property::findOrFail($backendProperty->id)->bedTypes()->get();
            $amenities = Amenity::where(['property_id'=>$backendProperty->id])->get();
            // dd($amenities);
        }
         // Set the featuredImages array with the existing images data
         $featuredImages = [
            'id' => null,
            'title' => 'room',
            'images' => [],
        ];
    
        if ($data->media->isNotEmpty()) {
            $featuredImages['id'] = $data->media->first()->id;
            $featuredImages['images'] = $data->media->map(function ($image) {
                return ['previewURL' => $image->original_url];
            })->toArray();
        }
    
        $data->featuredImages = $featuredImages;
    // dd($data);
        return Inertia::render('Rooms/CreateUpdate', compact('data', 'mealTypes', 'bedTypes','amenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            // dd($request->all());
            $request->validate([
                'name' => ['required'],
                'quantity' => ['required'],
                'meal_type' => ['required','array','min:1'],
                'bed_type' => ['required', 'array','min:1'],
                'max_adults' => ['nullable', 'numeric'],
                'max_child' => ['nullable', 'numeric'],
                'max_extra_beds' => ['nullable', 'numeric'],
                'default_web' => ['nullable', 'numeric'],
                'policies' => ['nullable'],
                'amenitites' => ['nullable'],
                'profile_image' => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:10000']
            ]);

        try {
            $backendProperty = PropertyController::getBackendProperty();
            if($backendProperty ){
                $propertyId = $backendProperty->id;
            } else {
                $propertyId = 0;
            }
            DB::beginTransaction();
 
            $model = Room::findOrFail($request->id);
            $model->room_no = 1;
            $model->name = $request->name;
            $model->quantity = $request->quantity;
            $model->max_adults = $request->max_adults;
            $model->max_child= $request->max_child;
            $model->max_extra_beds = $request->max_extra_beds;
            $model->web_quantity = $request->default_web;
            $model->description = $request->description;
            $model->property_id = $propertyId;
            $model->status = 1;
            $model->save();

          

            $model->mealTypes()->sync($request->meal_type);
            $model->bedTypes()->sync($request->bed_type);

            if ($request->has('featuredImages')) {
                $featuredImagesData = $request->featuredImages;
               // dd($featuredImagesData);
                if (isset($featuredImagesData['images']) && is_array($featuredImagesData['images'])) {
                    foreach ($featuredImagesData['images'] as $image) {
                        // Check if the item is an instance of UploadedFile
                        if ($image instanceof UploadedFile) {
                            // Process the uploaded file details
                            $originalName = $image->getClientOriginalName();
                            $mimeType = $image->getMimeType();
                            // ... (add any other details you need)
                            // dd($image);
                            // Example: Adding the file to the media collection
                            $model->addMedia($image->getRealPath())->toMediaCollection('Room');
                        } elseif (isset($image['id'])) {
                            // If it's an existing image with an ID, update it
                            $existingImage = Media::find($image['id']); // Assuming you have a Media model
        
                            if ($existingImage) {
                                // Update the existing image details if needed
                                // $model->addMedia($existingImage->getPath())->toMediaCollection('Room');
                            }
                        }
                    }
                }
            }
        
            
            DB::commit();
            return redirect()->route('room.index');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            return abort(500);
        }
    }
    public function deleteGalleryImage($id, Request $request)
    {
        $model = Media::find($id);
        // dd($model);
        $model->delete();
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $user = Room::find($request->id);
            if ($request->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();

            return redirect()->route('room.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
            // dd($request->all());
            try {
                Room::destroy([$request->ids]);
                return redirect()->route('room.index');
            } catch (Exception $ex) {
                Log::error($ex);
                return abort(500);
            }
        
    }
}
