<?php

namespace App\Http\Controllers;

use App\Follow;
use App\FollowNotifications;
use Illuminate\Http\Request;

class FollowsController extends Controller
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

        /* Add follow */
        $followQuery = Follow::where('followed', $request->musician)->where('username', auth()->user()->username)->count();
        if ($followQuery > 0) {
            Follow::where('followed', $request->musician)->where('username', auth()->user()->username)->delete();
            $message = "unfollowed";
        } else {
            $post = new Follow;
            $post->followed = $request->input('musician');
            $post->username = auth()->user()->username;
            $post->muted = "no";
            $post->blocked = "no";
            $post->save();
            $message = "followed";

            $notification = new FollowNotifications;
            $notification->username = $request->input('musician');
            $notification->follower = auth()->user()->username;
            $notification->save();

        }

        return redirect('posts')->with('success', 'You ' . $message . ' ' . $request->musician);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
