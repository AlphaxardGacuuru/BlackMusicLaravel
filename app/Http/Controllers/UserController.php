<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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

        $this->validate($request, [
            'username' => 'required|string|startsWith:@|min:2|max:15|unique:users',
            'phone' => 'required|string|startsWith:07|min:10|max:10|unique:users',
        ]);

        /* Insert notification */
        $notification = new Notifications;
        $notification->username = $request->input('username');
        $notification->message = 'Welcome ' . $request->input('username') . ', to Black Music.';
        $notification->save();

        /* User should follow him/herself */
        $follow = new Follow;
        $follow->followed = $request->input('username');
        $follow->username = $request->input('username');
        $follow->muted = "no";
        $follow->blocked = "no";
        $follow->save();

        /* User should follow @blackmusic */
        $follow = new Follow;
        $follow->followed = '@blackmusic';
        $follow->username = $request->input('username');
        $follow->muted = "no";
        $follow->blocked = "no";
        $follow->save();

        return User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'remember_token' => $data['remember_token'],
            'phone' => $request->input('phone'),
            'gender' => $data['gender'],
            'account_type' => 'normal',
            'pp' => 'profile-pics/male_avatar.png',
            'pb' => 'img/',
        ]);

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
