<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryController extends Controller
{
    public function index(Request $request) {
        $collectionName = $request->c != null ? $request->c : 'default';
        $user = User::find(Auth::user()->id);
        $mediaCollections = $collectionName == 'default' ? $user->getRegisteredMediaCollections() : [];
        $collectionMedia = $user->getMedia($collectionName);
        // dd($request);
        return Inertia::render('MediaLibrary/Index', ['collections'=>$mediaCollections, 'allMedia' => $collectionMedia]);
    }

    public function download($id) {
        $mediaItem = Media::find($id);
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }

    public function upload(Request $request) {
        $user = User::find(auth()->user()->id);
        try {
            if($request->hasFile('file')) {
               $file = $user->addMedia($request->file('file'))->toMediaCollection($request->collection);
            }
            return redirect()->route('media.index', ['c'=>$request->collection]);
        } catch (Exception $ex) {
            dd($ex);
            return abort(500);
        }
    }

    public function delete(Request $request) {
        $mediaItem = Media::find($request->id);
        $mediaItem->delete();
        return back();
    }
}
