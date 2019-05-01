<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Gallery;

class GalleryController extends Controller
{
    public function index()
    {

    }
    public function create()
    {

    }

    public function store(Request $request)
    {
        $path = $request->file('file')->store('images', 'public');
        $gallery = new Gallery();
        $gallery->id_user = $request->input('id_user');
        $gallery->subtitle = $request->input('subtitle');
        $gallery->file = $path;
        $gallery->save();
        return redirect('/gallery');
    }

    public function download($id)
    {
        $gallery = Gallery::find($id);
        if(isset($gallery)) {
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($gallery->file);
            return response()->download($path);
        }
    }

    public function show()
    {
        $user = Auth::user()->id;
        $gallery = Gallery::where('id_user', $user)->get();
        return view('gallery', compact(['gallery']));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if(isset($gallery)) {
            $file = $gallery->file;
            Storage::disk('public')->delete($file);
            $gallery->delete();
        }
        return redirect('/gallery');
    }
}
