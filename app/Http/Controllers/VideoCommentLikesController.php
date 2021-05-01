<?php

namespace App\Http\Controllers;

use App\VideoCommentLikes;
use Illuminate\Http\Request;

class VideoCommentLikesController extends Controller
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
        $videoCommentLikeCount = VideoCommentLikes::where('comment_id', $request->input('comment-id'))->where('username', auth()->user()->username)->count();
        if ($videoCommentLikeCount > 0) {
            VideoCommentLikes::where('comment_id', $request->input('comment-id'))->where('username', auth()->user()->username)->delete();
            $message = "Like removed";
        } else {
            $videoCommentLike = new VideoCommentLikes;
            $videoCommentLike->comment_id = $request->input('comment-id');
            $videoCommentLike->username = auth()->user()->username;
            $videoCommentLike->save();
            $message = "Comment liked";
        }

        return redirect('/video-charts/' . $request->input('video-id'))->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoCommentLikes  $videoCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function show(VideoCommentLikes $videoCommentLikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoCommentLikes  $videoCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoCommentLikes $videoCommentLikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoCommentLikes  $videoCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoCommentLikes $videoCommentLikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoCommentLikes  $videoCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoCommentLikes $videoCommentLikes)
    {
        //
    }
}
