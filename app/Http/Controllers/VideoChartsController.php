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

class VideoChartsController extends Controller
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
        /* foreach ($videos as $video) {
        $fix = Videos::find($video->video_id);
        $thumbnail = substr($video->video, 30);
        $thumbnail = "https://img.youtube.com/vi/" . $thumbnail . "/hqdefault.jpg";
        $fix->video_thumbnail = $thumbnail;
        $fix->save();
        } */

        return view('/pages/video-charts')->with(['chart' => $chart, 'vGenre' => $vGenre, 'videos' => $videos]);
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
        $users = User::orderBy('id', 'desc')->get();
        $follows = Follow::get();
        $videoComments = VideoComments::where('video_id', $id)->orderBy('id', 'desc')->get();
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
