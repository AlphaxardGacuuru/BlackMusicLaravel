<?php

namespace App\Http\Controllers;

use App\Referrals;
use Illuminate\Http\Request;

class ReferralsController extends Controller
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
        $referrals = Referrals::where('username', auth()->user()->username)->get();
        return view('/pages/invites')->with(['referrals' => $referrals]);
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
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function show(Referrals $referrals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function edit(Referrals $referrals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referrals $referrals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referrals $referrals)
    {
        //
    }
}
