<?php

namespace App\Http\Controllers;

use App\AudioCommentLikes;
use App\AudioComments;
use App\AudioLikes;
use App\Audios;
use App\BoughtAudios;
use App\CartAudios;
use App\Follow;
use App\User;
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
        $audios = Audios::get();
        return view('/pages/audio-charts')->with(['chart' => $chart, 'vGenre' => $vGenre, 'audios' => $audios]);
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
        $audios = Audios::get();
        $cartAudios = CartAudios::get();
        $boughtAudios = BoughtAudios::get();
        $audioLikes = AudioLikes::where('audio_id', $id)->get();
        $users = User::orderBy('id', 'desc')->get();
        $follows = Follow::get();
        $audioComments = AudioComments::where('audio_id', $id)->orderBy('id', 'desc')->get();
        $audioCommentLikes = AudioCommentLikes::get();

        return view('/pages/audio-show')->with(['id' => $id, 'audios' => $audios, 'cartAudios' => $cartAudios, 'boughtAudios' => $boughtAudios, 'audioLikes' => $audioLikes, 'users' => $users, 'follows' => $follows, 'audioComments' => $audioComments, 'audioCommentLikes' => $audioCommentLikes]);
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
