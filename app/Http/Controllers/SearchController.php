<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\CartVideos;
use App\Follow;
use App\Search;
use App\User;
use App\Videos;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/pages/search')->with('data', 'some');
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
        $search = new Search;
        $search->keyword = $request->input('search');
        $search->save();

        /* Search for users */
        $results = User::where('username', 'like', '%' . $request->input('search') . '%')->where('account_type', 'musician')->orWhere('name', 'like', '%' . $request->input('search') . '%')->where('account_type', 'musician')->get();
        $follows = Follow::get();
        $videos = Videos::orderBy('id', 'desc')->get();
        $boughtVideos = BoughtVideos::get();
        $cartVideos = CartVideos::get();

        /* Search for songs */
        $videoResults = Videos::where('name', 'like', '%' . $request->input('search') . '%')->where('username', '!=', auth()->user()->username)->get();

        return view('/pages/search')->with(['results' => $results, 'videoResults' => $videoResults, 'follows' => $follows, 'videos' => $videos, 'boughtVideos' => $boughtVideos, 'cartVideos' => $cartVideos, 'keyword' => $request->input('search')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function show(Search $search)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function edit(Search $search)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Search $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {
        //
    }
}
