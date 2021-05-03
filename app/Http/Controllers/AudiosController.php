<?php

namespace App\Http\Controllers;

use App\AudioAlbums;
use App\AudioPayouts;
use App\Audios;
use App\BoughtAudios;
use Illuminate\Http\Request;

class AudiosController extends Controller
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
        $audios = Audios::where('username', auth()->user()->username)->orderby('id', 'DESC')->get();
        $audiosSingles = Audios::where('username', auth()->user()->username)->Where('album', '')->orWhere('album', 'Single')->get();
        $audioAlbums = AudioAlbums::where('username', auth()->user()->username)->orderby('id', 'ASC')->get();
        $downloads = BoughtAudios::where('artist', auth()->user()->username)->count();
        $audioPayouts = AudioPayouts::where('username', auth()->user()->username)->sum('amount');

        return view('/pages/audios')->with(['audios' => $audios, 'audiosSingles' => $audiosSingles, 'audioAlbums' => $audioAlbums, 'downloads' => $downloads, 'audioPayouts' => $audioPayouts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $audioAlbums = AudioAlbums::where('username', auth()->user()->username)->get();
        return view('/pages/audio-create')->with(['audioAlbums' => $audioAlbums]);
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
            'audio-name' => 'required|string',
            'audio-description' => 'required|string',
            'audio-thumbnail' => 'required|image|max:1999',
            /* 'audio' => 'required|file|mimes:
        application/octet-stream,
        audio/mpeg,
        audio/mpga,
        audio/mp3,
        audio/wav,
        application/m4a', */
        ]);

        /* Handle file upload */
        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('public/audios');
            $audioPath = substr($audioPath, 7);
        }

        if ($request->hasFile('audio-thumbnail')) {
            $thumbnail = $request->file('audio-thumbnail')->store('public/audio-thumbnails');
            $thumbnail = substr($thumbnail, 7);
        }

        /* Create new audio song */
        $audio = new Audios;
        $audio->audio = $audioPath;
        $audio->name = $request->input('audio-name');
        $audio->username = auth()->user()->username;
        if ($request->ft) {
            $ftCheck = User::where('username', $request->ft)->count();
            if ($ftCheck > 0) {
                $audio->ft = $request->input('ft') ? $request->input('ft') : "";
            } else {
                return redirect('/audios/create')->with('error', 'Featuring artist must have an account.');
            }
        }
        $audio->album = $request->input('audio-album');
        $audio->genre = $request->input('audio-genre');
        $audio->thumbnail = $thumbnail;
        $audio->description = $request->input('audio-description');
        $audio->released = $request->input('audio-released');
        $audio->save();

        return redirect('/audios/create')->with('success', 'Audio Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Audios  $audios
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Audios  $audios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audio = Audios::where('id', $id)->first();
        $audioAlbums = AudioAlbums::where('username', auth()->user()->username)->orderby('id', 'ASC')->get();
        return view('/pages/audio-edit')->with(['audio' => $audio, 'audioAlbums' => $audioAlbums]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Audios  $audios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|nullable|max:20',
        ]);

        /* Update audio */
        $audio = audios::find($id);
        if ($request->filled('audio-name')) {
            $audio->name = $request->input('audio-name');
        }

        if ($request->filled('ft')) {
            $ftCheck = User::where('username', $request->ft)->count();
            if ($ftCheck > 0) {
                $audio->ft = $request->input('ft') ? $request->input('ft') : "";
            } else {
                return redirect('/audios/' . $id . '/edit')->with('error', 'Featuring artist must have an account.');
            }
        }

        if ($request->filled('audio-album')) {
            $audio->album = $request->input('audio-album');
        }

        if ($request->filled('audio-genre')) {
            $audio->genre = $request->input('audio-genre');
        }

        /* Handle file upload */
        if ($request->hasFile('audio-thumbnail')) {
            Storage::delete('public/' . $audio->thumbnail);
            $thumbnail = $request->file('audio-thumbnail')->store('public/audio-thumbnails');
            $thumbnail = substr($thumbnail, 7);
            $audio->thumbnail = $thumbnail;
        }

        if ($request->filled('audio-description')) {
            $audio->description = $request->input('audio-description');
        }

        $audio->save();
        return redirect('/audios/' . $id . '/edit')->with('success', 'Audio Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audios  $audios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audios $audios)
    {
        //
    }
}
