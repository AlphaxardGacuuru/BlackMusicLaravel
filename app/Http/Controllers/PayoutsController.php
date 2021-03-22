<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\Payouts;
use App\User;
use App\Videos;
use Illuminate\Http\Request;

class PayoutsController extends Controller
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
        $users = User::orderBy('user_id', 'desc');
        $videos = Videos::get();
        $boughtVideos = BoughtVideos::get();
        $payouts = Payouts::get();

        return view('pages/admin')->with(['users' => $users, 'videos' => $videos, 'boughtVideos' => $boughtVideos, 'payouts' => $payouts]);
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
        $payout = new Payouts;
        $payout->username = $request->input('artist');
        $payout->amount = $request->input('amount');
        $payout->save();

        return redirect('admin')->with('success', 'Payout added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payouts  $payouts
     * @return \Illuminate\Http\Response
     */
    public function show(Payouts $payouts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payouts  $payouts
     * @return \Illuminate\Http\Response
     */
    public function edit(Payouts $payouts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payouts  $payouts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payouts $payouts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payouts  $payouts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payouts $payouts)
    {
        //
    }
}
