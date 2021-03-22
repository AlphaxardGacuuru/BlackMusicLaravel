<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\CartVideos;
use App\Decos;
use App\User;
use App\VideoNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoughtVideosController extends Controller
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
        $boughtVideos = BoughtVideos::where('username', auth()->user()->username)->orderby('bought_video_id', 'DESC')->get();
        return view('/pages/library')->with('boughtVideos', $boughtVideos);
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
        $permission = "";
        /* Fetch songs from vs_cart */
        $vCartCheck = CartVideos::where('username', auth()->user()->username)->get();
        foreach ($vCartCheck as $vCartCheck) {
            $totalVideos = BoughtVideos::where('username', auth()->user()->username)->count() * 20;
            $kopokopo = DB::table('kopokopo')->where('sender_phone', auth()->user()->phone)->sum('amount');
            $balance = $kopokopo - $totalVideos;
            $permission = intval($balance / 20);
            if ($permission >= 1) {
                $bvQuery = BoughtVideos::where('username', auth()->user()->username)->where('video_id', $vCartCheck->video_id)->count();
                $vsQuery = DB::table('videos')->where('id', $vCartCheck->video_id)->get();
                if ($bvQuery == 0) {
                    /* Add song to videos_bought */
                    $boughtVideos = new BoughtVideos;
                    $boughtVideos->video_id = $vCartCheck->video_id;
                    $boughtVideos->bought_video_reference = "ODT2TA2060";
                    $boughtVideos->username = auth()->user()->username;
                    $boughtVideos->bought_video_name = $vCartCheck->videos->video_name;
                    $boughtVideos->bought_video_artist = $vCartCheck->videos->username;
                    $boughtVideos->save();

                    /* Showing video song bought notification */
                    $videoNotifications = new VideoNotifications;
                    $videoNotifications->video_id = $vCartCheck->video_id;
                    $videoNotifications->username = auth()->user()->username;
                    $videoNotifications->vn_artist = $vCartCheck->videos->username;
                    $videoNotifications->save();

                    /* Add deco if necessary */
                    /* Check if songs are 10 */
                    $userDecos = DB::table('decos')->where('username', auth()->user()->username)->where('deco_from', $vCartCheck->videos->username)->count();
                    $uservideos = DB::table('bought_videos')->where('username', auth()->user()->username)->where('username', $vCartCheck->videos->username)->count();
                    $uservideos = $uservideos / 10;
                    $decoBalance = $uservideos - $userDecos;
                    $decoPermission = intval($decoBalance);

                    /* If deco balance >= 1 then add deco */
                    if ($decoPermission >= 1) {
                        $deco = new Decos;
                        $deco->deco_to = auth()->user()->username;
                        $deco->deco_from = $vCartCheck->video->username;
                        $deco->save();

                        /* Add deco notification */
                        $decoNotification = new DecoNotifications;
                        $decoNotification->dn_to = auth()->user()->username;
                        $decoNotification->dn_from = $vCartCheck->video->username;
                        $decoNotification->save();
                    }
                    /* Delete from cart */
                    CartVideos::find($vCartCheck->cart_video_id)->delete();
                }
            }
        }

        $cartVideos = CartVideos::where('username', auth()->user()->username)->get();
        $boughtVideos = BoughtVideos::where('username', auth()->user()->username)->get();
        $totalVideos = BoughtVideos::where('username', auth()->user()->username)->count() * 20;
        $kopokopo = DB::table('kopokopo')->where('sender_phone', auth()->user()->phone)->sum('amount');
        $balance = $kopokopo - $totalVideos;

        return view('pages/receipt')->with(['cartVideos' => $cartVideos, 'boughtVideos' => $boughtVideos, 'permission' => $permission, 'balance' => $balance]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoughtVideos  $boughtVideos
     * @return \Illuminate\Http\Response
     */
    public function show(BoughtVideos $boughtVideos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoughtVideos  $boughtVideos
     * @return \Illuminate\Http\Response
     */
    public function edit(BoughtVideos $boughtVideos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoughtVideos  $boughtVideos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoughtVideos $boughtVideos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoughtVideos  $boughtVideos
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoughtVideos $boughtVideos)
    {
        //
    }
}
