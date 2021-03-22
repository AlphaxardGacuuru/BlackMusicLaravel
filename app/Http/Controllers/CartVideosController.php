<?php

namespace App\Http\Controllers;

use App\CartVideos;
use App\Videos;
use Illuminate\Http\Request;

class CartVideosController extends Controller
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
        $cartVideos = cartVideos::where('username', auth()->user()->username)->get();
        $videos = Videos::get();

        return view('pages/cart')->with(['cartVideos' => $cartVideos, 'videos' => $videos]);
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
        /* Check if item is already in cart */
        $vcartCheck = CartVideos::where('video_id', $request->input('cart-video-song'))->where('username', auth()->user()->username)->count();
        /* Insert to cart */
        if ($vcartCheck == 0) {
            $cartVideos = new CartVideos;
            $cartVideos->video_id = $request->input('cart-video-song');
            $cartVideos->username = auth()->user()->username;
            $cartVideos->save();
        }
        $to = $request->input('to');
        return redirect($to)->with('success', 'Song added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CartVideos  $cartVideos
     * @return \Illuminate\Http\Response
     */
    public function show(CartVideos $cartVideos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartVideos  $cartVideos
     * @return \Illuminate\Http\Response
     */
    public function edit(CartVideos $cartVideos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartVideos  $cartVideos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartVideos $cartVideos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartVideos  $cartVideos
     * @return \Illuminate\Http\Response
     */
    public function destroy($cartVideo)
    {
        $cartVideo = CartVideos::find($cartVideo)->delete();
        return redirect('cart')->with('success', 'Item removed');
    }
}
