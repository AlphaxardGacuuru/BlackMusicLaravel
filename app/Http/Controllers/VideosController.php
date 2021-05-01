<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\Payouts;
use App\User;
use App\VideoAlbums;
use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
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
        $videos = Videos::where('username', auth()->user()->username)->orderby('id', 'DESC')->get();
        $videosSingles = Videos::where('username', auth()->user()->username)->Where('album', '')->orWhere('album', 'Single')->get();
        $videoAlbums = VideoAlbums::where('username', auth()->user()->username)->orderby('id', 'ASC')->get();
        $downloads = BoughtVideos::where('artist', auth()->user()->username)->count();
        $payouts = Payouts::where('username', auth()->user()->username)->sum('amount');
        return view('/pages/videos')->with(['videos' => $videos, 'videosSingles' => $videosSingles, 'videoAlbums' => $videoAlbums, 'downloads' => $downloads, 'payouts' => $payouts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videoAlbums = VideoAlbums::where('username', auth()->user()->username)->get();
        return view('/pages/video-create')->with(['videoAlbums' => $videoAlbums]);
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
            'video-name' => 'required|string',
            'video' => 'regex:/^https:\/\/youtu.be\/[A-z0-9]+/',
            /* 'video' => 'required|file|mimetypes:video/mp4,
        video/mpeg,
        video/x-matroska,
        video/x-flv,
        application/x-mpegURL,
        video/MP2T,
        video/3gpp,
        video/quicktime,
        video/x-msvideo,
        video/x-ms-wmv', */
        ]);

        /* Handle file upload */
        /* if ($request->hasFile('video')) {
        Storage::putFile('public/video-uploads', $request->file('video'));
        $path = $request->file('video')->hashName();
        return $path = $request->file('video')->hashName();
        }
        return ''; */

        /* Create new video song */
        $video = new Videos;
        /* Change url to enable embedding */
        $video->video = substr_replace($request->input('video'), 'https://www.youtube.com/embed', 0, 16);
        $video->name = $request->input('video-name');
        $video->username = auth()->user()->username;
        if ($request->ft) {
            $ftCheck = User::where('username', $request->ft)->count();
            if ($ftCheck > 0) {
                $video->ft = $request->input('ft') ? $request->input('ft') : "";
            } else {
                return redirect('/videos/create')->with('error', 'Featuring artist must have an account.');
            }
        }
        $video->album = $request->input('video-album');
        $video->genre = $request->input('video-genre');
        /* Generate thumbnail */
        $thumbnail = substr($video->video, 30);
        $thumbnail = "https://img.youtube.com/vi/" . $thumbnail . "/hqdefault.jpg";
        $video->thumbnail = $thumbnail;
        $video->description = $request->input('video-description');
        $video->released = $request->input('video-released');
        $video->save();

        return redirect('/videos/create')->with('success', 'Video Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function show(Videos $videos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Videos::where('id', $id)->first();
        $videoAlbums = VideoAlbums::where('username', auth()->user()->username)->orderby('id', 'ASC')->get();
        return view('pages/video-edit')->with(['video' => $video, 'videoAlbums' => $videoAlbums]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|nullable|max:20',
            'video' => 'regex:/^https:\/\/youtu.be\/[A-z0-9]+/',
        ]);

        /* Update video */
        $video = Videos::find($id);
        if ($request->filled('video')) {
            /* Change url to enable embedding */
            $url = substr_replace($request->input('video'), 'https://www.youtube.com/embed', 0, 16);
            $video->video = $url;
            /* Generate thumbnail */
            $thumbnail = substr($url, 30);
            $thumbnail = "https://img.youtube.com/vi/" . $thumbnail . "/hqdefault.jpg";
            $video->thumbnail = $thumbnail;
        }

        if ($request->filled('video-name')) {
            $video->name = $request->input('video-name');
        }

        if ($request->filled('ft')) {
            $ftCheck = User::where('username', $request->ft)->count();
            if ($ftCheck > 0) {
                $video->ft = $request->input('ft') ? $request->input('ft') : "";
            } else {
                return redirect('/videos/' . $id . '/edit')->with('error', 'Featuring artist must have an account.');
            }
        }

        if ($request->filled('video-album')) {
            $video->album = $request->input('video-album');
        }

        if ($request->filled('video-genre')) {
            $video->genre = $request->input('video-genre');
        }

        /* Handle file upload */
        if ($request->hasFile('vArt')) {
            Storage::delete('public/' . $video->thumbnail);
            $vArt = $request->file('vArt')->store('public/vArt');
            $vArt = substr($vArt, 7);
            $video->thumbnail = $vArt;
        }

        if ($request->filled('video-description')) {
            $video->description = $request->input('description');
        }

        if ($request->filled('video-released')) {
            $video->released = $request->input('video-released');
        }

        $video->save();
        return redirect('/videos/' . $id . '/edit')->with('success', 'Video Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videos $videos)
    {
        //
    }
}
