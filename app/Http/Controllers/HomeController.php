<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\CartVideos;
use App\Follow;
use App\Polls;
use App\Post;
use App\User;
use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/settings');
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
        $posts = Post::orderBy('post_id', 'desc')->get();
        $users = User::orderBy('user_id', 'desc')->get();
        $follows = Follow::get();
        $videos = Videos::orderBy('id', 'desc')->get();
        $boughtVideos = BoughtVideos::get();
        $cartVideos = CartVideos::get();
        $polls = Polls::get();

        return view('pages/profile')->with(['follows' => $follows, 'posts' => $posts, 'polls' => $polls, 'videos' => $videos, 'cartVideos' => $cartVideos, 'boughtVideos' => $boughtVideos, 'id' => $id, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages/profile-edit');
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
        $this->validate($request, [
            'name' => 'string|nullable|max:20',
            'phone' => 'string|nullable|startsWith:07|min:10|max:10',
            'email' => 'string|nullable|email|max:255|unique:users',
            'password' => 'string|nullable|min:8|confirmed',
            'profile-pic' => 'image|nullable|max:9999',
            'bio' => 'string|nullable|max:50',
            'loc' => 'string|nullable',
            'withdrawal' => 'string|nullable',
        ]);

        /* Handle file upload */
        if ($request->hasFile('profile-pic')) {
            $pp = $request->file('profile-pic')->store('public/profile-pics');
            if (auth()->user()->pp != 'profile-pics/male_avatar.png') {
                Storage::delete('public/' . auth()->user()->pp);
            }
            $pp = substr($pp, 7);
        }

        /* Update profile */
        $user = User::find($id);
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        } else {
            $user->name = auth()->user()->name;
        }
        if ($request->filled('phone')) {
            $user->phone = $request->input('phone');
        } else {
            $user->phone = auth()->user()->phone;
        }
        if ($request->filled('acc-type')) {
            $user->acc_type = $request->input('acc-type');
        } else {
            $user->acc_type = auth()->user()->acc_type;
        }
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        } else {
            $user->email = auth()->user()->email;
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        } else {
            $user->password = auth()->user()->password;
        }
        if ($request->hasFile('profile-pic')) {
            $user->pp = $pp;
        } else {
            $user->pp = auth()->user()->pp;
        }
        if ($request->filled('bio')) {
            $user->bio = $request->input('bio');
        } else {
            $user->bio = auth()->user()->bio;
        }
        if ($request->filled('loc')) {
            $user->location = $request->input('loc');
        } else {
            $user->location = auth()->user()->location;
        }
        if ($request->filled('withdrawal')) {
            $user->withdrawal = $request->input('withdrawal');
        } else {
            $user->withdrawal = auth()->user()->withdrawal;
        }
        $user->save();
        if ($request->input('to') == 'settings') {
            return redirect('/home/create')->with('success', 'Account Updated');
        } else {
            return redirect('/home/' . Auth()->user()->username . '/edit')->with('success', 'Account Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/')->with('success', 'Post Deleted');

    }
}
