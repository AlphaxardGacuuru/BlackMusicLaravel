<?php

namespace App\Http\Controllers;

use App\VideoNotifications;
use Illuminate\Http\Request;

class VideoNotificationsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoNotifications  $videoNotifications
     * @return \Illuminate\Http\Response
     */
    public function show(VideoNotifications $videoNotifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoNotifications  $videoNotifications
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoNotifications $videoNotifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoNotifications  $videoNotifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoNotifications $videoNotifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoNotifications  $videoNotifications
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vn = VideoNotifications::find($id)->first();
        $vn->delete();
        return redirect('/home/' . $vn->username);
    }
}
