<?php

namespace App\Http\Controllers;

use App\AudioAlbums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioAlbumsController extends Controller
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
        return view('/pages/audio-album-create');
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
            'cover' => 'required|image|max:1999',
        ]);

        /* Handle file upload */
        if ($request->hasFile('cover')) {
            $aCover = $request->file('cover')->store('public/audio-album-cover');
            $aCover = substr($aCover, 7);
        }

        /* Create new audio album */
        $aAlbum = new audioAlbums;
        $aAlbum->name = $request->input('name');
        $aAlbum->username = auth()->user()->username;
        $aAlbum->cover = $aCover;
        $aAlbum->released = $request->input('released');
        $aAlbum->save();

        return redirect('audio-albums/create')->with('success', 'Audio Album Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AudioAlbums  $audioAlbums
     * @return \Illuminate\Http\Response
     */
    public function show(AudioAlbums $audioAlbums)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AudioAlbums  $audioAlbums
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audioAlbum = audioAlbums::where('id', $id)->first();
        return view('/pages/audio-album-edit')->with('audioAlbum', $audioAlbum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AudioAlbums  $audioAlbums
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|nullable|max:20',
            'cover' => 'image|max:1999',
        ]);

        /* Update audio */
        $audioAlbum = audioAlbums::find($id);
        if ($request->filled('name')) {
            $audioAlbum->name = $request->input('name');
        }

        if ($request->filled('released')) {
            $audioAlbum->released = $request->input('released');
        }

        /* Handle file upload */
        if ($request->hasFile('cover')) {
            Storage::delete('public/' . $audioAlbum->cover);
            $aCover = $request->file('cover')->store('public/audio-album-covers');
            $aCover = substr($aCover, 7);
            $audioAlbum->cover = $aCover;
        }

        $audioAlbum->save();
        return redirect('/audio-albums/' . $id . '/edit')->with('success', 'Audio Album Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AudioAlbums  $audioAlbums
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudioAlbums $audioAlbums)
    {
        //
    }
}
