<?php

namespace App\Http\Controllers;

use App\User;
use App\VideoAlbums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoAlbumsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/pages/video-album-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cover' => 'image|max:1999',
        ]);

        /* Handle file upload */
        if ($request->hasFile('cover')) {
            $vCover = $request->file('cover')->store('public/video-album-covers');
            $vCover = substr($vCover, 7);
        }

        /* Create new video album */
        $vAlbum = new VideoAlbums;
        $vAlbum->name = $request->input('name');
        $vAlbum->username = auth()->user()->username;
        $vAlbum->cover = $vCover;
        $vAlbum->released = $request->input('released');
        $vAlbum->save();

        return redirect('video-albums/create')->with('success', 'Video Album Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoAlbums  $vAlbumAlbums
     * @return \Illuminate\Http\Response
     */
    public function show(VideoAlbums $vAlbumAlbums)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoAlbums  $vAlbumAlbums
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videoAlbum = VideoAlbums::where('id', $id)->first();
        return view('/pages/video-album-edit')->with('videoAlbum', $videoAlbum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoAlbums  $vAlbumAlbums
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|nullable|max:20',
            'cover' => 'image|max:1999',
        ]);

        /* Update video */
        $videoAlbum = VideoAlbums::find($id);
        if ($request->filled('name')) {
            $videoAlbum->name = $request->input('name');
        }

        if ($request->filled('released')) {
            $videoAlbum->released = $request->input('released');
        }

        /* Handle file upload */
        if ($request->hasFile('cover')) {
            Storage::delete('public/' . $videoAlbum->cover);
            $vCover = $request->file('cover')->store('public/video-album-cover');
            $vCover = substr($vCover, 7);
            $videoAlbum->cover = $vCover;
        }

        $videoAlbum->save();
        return redirect('/video-albums/' . $id . '/edit')->with('success', 'Video Album Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoAlbums  $vAlbumAlbums
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoAlbums $vAlbumAlbums)
    {
        //
    }
}
