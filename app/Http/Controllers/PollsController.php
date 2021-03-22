<?php

namespace App\Http\Controllers;

use App\Polls;
use Illuminate\Http\Request;

class PollsController extends Controller
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
        $poll = new Polls;
        $poll->post_id = $request->input('post-id');
        $poll->username = auth()->user()->username;
        $poll->parameter = $request->input('parameter');
        $poll->save();
        return redirect('posts')->with("success", "You've voted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Polls  $polls
     * @return \Illuminate\Http\Response
     */
    public function show(Polls $polls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Polls  $polls
     * @return \Illuminate\Http\Response
     */
    public function edit(Polls $polls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Polls  $polls
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Polls $polls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Polls  $polls
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polls $polls)
    {
        //
    }
}
