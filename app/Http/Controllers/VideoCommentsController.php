<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\VideoCommentLikes;
use App\VideoComments;
use Illuminate\Http\Request;

class VideoCommentsController extends Controller
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
        /* Check if user has bought the song */
        $boughtVideosQuery = BoughtVideos::where('username',
            auth()->user()->username)->where('bought_video_artist', $request->input('musician'))->where('video_id', $request->input('video-id'))->count();
        if ($boughtVideosQuery > 0 || auth()->user()->username == '@blackmusic') {
            /* Create new post */
            $videoComment = new VideoComments;
            $videoComment->video_id = $request->input('video-id');
            $videoComment->username = auth()->user()->username;
            $videoComment->text = $request->input('video-comment-text');
            $videoComment->save();

            return redirect('/charts/' . $request->input('video-id'))->with('success', 'Comment Posted');
        } else {
            return redirect('/charts/' . $request->input('video-id'))->with('error', 'You cannot comment if you have not bought the song');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoComments  $videoComments
     * @return \Illuminate\Http\Response
     */
    public function show(VideoComments $videoComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoComments  $videoComments
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoComments $videoComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoComments  $videoComments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoComments $videoComments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoComments  $videoComments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $videoComment = VideoComments::where('video_comment_id', $id)->first();
        $deleteCLikes = VideoCommentLikes::where('video_comment_id', $id)->delete();
        VideoComments::find($id)->delete();
        return redirect('/charts/' . $videoComment->video_id)->with('success', 'Comment deleted');
    }
}
