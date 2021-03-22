<?php

namespace App\Http\Controllers;

use App\VideoLikes;
use Illuminate\Http\Request;

class VideoLikesController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $videoLikeCount = VideoLikes::where('video_id', $request->input('video-id'))->where('username', auth()->user()->username)->count();
        if ($videoLikeCount > 0) {
            VideoLikes::where('video_id', $request->input('video-id'))->where('username', auth()->user()->username)->delete();
            $message = "Like removed";
        } else {
            $videoLike = new VideoLikes;
            $videoLike->video_id = $request->input('video-id');
            $videoLike->username = auth()->user()->username;
            $videoLike->save();
            $message = "Video liked";
        }

        return redirect('/charts/' . $request->input('video-id'))->with('success', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoLikes  $videoLikes
     * @return \Illuminate\Http\Response
     */
    public function show(VideoLikes $videoLikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoLikes  $videoLikes
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoLikes $videoLikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoLikes  $videoLikes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoLikes $videoLikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoLikes  $videoLikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoLikes $videoLikes)
    {
        //
    }
}
