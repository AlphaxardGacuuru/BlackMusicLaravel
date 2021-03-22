<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\CartVideos;
use App\Follow;
use App\User;
use App\VideoCommentLikes;
use App\VideoComments;
use App\VideoLikes;
use App\Videos;
use Illuminate\Http\Request;

class AudioChartsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chart, $vGenre)
    {
        $videos = Videos::get();
        return view('/pages/audio-charts')->with(['chart' => $chart, 'vGenre' => $vGenre, 'videos' => $videos]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $videos = Videos::get();
        $cartVideos = CartVideos::get();
        $boughtVideos = BoughtVideos::get();
        $videoLikes = VideoLikes::where('video_id', $id)->get();
        $users = User::orderBy('user_id', 'desc')->get();
        $follows = Follow::get();
        $videoComments = VideoComments::where('video_id', $id)->orderBy('video_comment_id', 'desc')->get();
        $videoCommentLikes = VideoCommentLikes::get();

        return view('/pages/video-show')->with(['id' => $id, 'videos' => $videos, 'cartVideos' => $cartVideos, 'boughtVideos' => $boughtVideos, 'videoLikes' => $videoLikes, 'users' => $users, 'follows' => $follows, 'videoComments' => $videoComments, 'videoCommentLikes' => $videoCommentLikes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
