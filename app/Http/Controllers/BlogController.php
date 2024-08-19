<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlogController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Blogs/Index');
    }
    public function getData()
    {
        $user = Auth::user();
        $roleType = $user && count($user->roles) > 0 ? $user->roles[0]->type : null;

        if ($roleType == 'admin') {
            $data = Blog::get();
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
                if (auth()->user()->can('blog.view') && auth()->user()->can('blog.edit')) {
                    $action_html .= '<a class="dropdown-item action_edit" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" href="javascript:void(0)"><i class="fas fa-edit mr-2"></i> View / Edit</a>';
                }
                if (auth()->user()->can('blog.edit')) {
                    $action_html .= '<a class="dropdown-item ' . ($row->status == 'active'? 'text-warning' : 'text-success') . ' action_status_change" style="font-size: 14px;padding: 5px 13px;" data-item-id="' . $row->id . '" data-status="' . $row->status . '" href="javascript:void(0)"><i class="fas fa-power-off mr-2"></i>' . ($row->status == 'active' ? ' Inactive' : ' Active') . '</a> ';
                }
                $action_html .= '<div class="dropdown-divider"></div>';
                if (auth()->user()->can('blog.delete')) {
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
                return $row->status == 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';
            })
            ->rawColumns(['check', 'action',  'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Blogs/CreateUpdate');
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
        'title' => ['required'],
        'description' => ['nullable'],
        'status' => ['required'],
    ]);
   

    try {
        DB::beginTransaction();
        
        $model = new Blog();
        $model->title = $request->title;
        $model->description = $request->description;
        
        // $model->image = $image;
        $model->status = $request->status;
        $model->save();

        if ($request->hasFile('image')) {
            $model -> addMedia($request->file('image'))->toMediaCollection('Blog');
            $model->save();
        }
        
        DB::commit();
        return redirect(route('blogs.index'));
    } catch (Exception $e) {
        DB::rollBack(); 
        dd($e);    
        abort(500);
    }
}

public function edit($id)
{
    
    $data = Blog::with('media')->find($id);
    // dd($data);
    Log::info($data);
    return Inertia::render('Blogs/CreateUpdate', ['data' => $data]);
}
    public function update(Request $request)
{
    $request->validate([
        
        'title' => ['required'],
        'description' => ['required'],
        // 'image' => ['nullable'],
        // 'image' => ['required'],
        'status' => ['required'],
    ]);

    try {
        DB::beginTransaction();
        $model = Blog::find($request->id);
        $model->title = $request->title;          
        $model->description = $request->description;
       
        // $model->image = $request->image;
        $model->status = $request->status;
        $model->save();
        if ($request->hasFile('image')) {
            $model->getMedia('Blog')->first()->delete();

            $model -> addMedia($request->file('image'))->toMediaCollection('Blog');
            $model->save();
        }
        DB::commit();
        return redirect(route('blogs.index'));
    } catch (Exception $e) {
        DB::rollBack();
        Log::error($e);
        abort(500);
    }
}
public function updateStatus(Request $request)
{
    try {
        $blog = Blog::find($request->id);

        if (!$blog) {
            // Handle the case where the blog is not found.
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        }

        // Toggle the status
        $blog->status = $blog->status == 'active' ? 'inactive' : 'active';
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog status updated successfully.');
    } catch (Exception $ex) {
        Log::error($ex);
        return redirect()->route('blogs.index')->with('error', 'An error occurred while updating blog status.');
    }
}
/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Blog::destroy([$request->ids]);
            return redirect()->route('blogs.index');
        } catch (Exception $ex) {
            Log::error($ex);
            return abort(500);
        }
    }

}
    


