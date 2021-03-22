<?php

namespace App\Http\Controllers\Auth;

use App\Follow;
use App\Http\Controllers\Controller;
use App\Notifications;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    /* protected $redirectTo = RouteServiceProvider::HOME; */
    protected $redirectTo = 'posts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'startsWith:@', 'min:2', 'max:15', 'unique:users'],
            'phone' => ['required', 'string', 'startsWith:07', 'min:10', 'max:10', 'unique:users'],
            /* 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], */
            /* 'password' => ['required', 'string', 'min:8', 'confirmed'], */
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /* Insert notification */
        $notification = new Notifications;
        $notification->username = $data['username'];
        $notification->message = 'Welcome ' . $data['username'] . ', to Black Music.';
        $notification->save();

        /* User should follow him/herself */
        $follow = new Follow;
        $follow->followed = $data['username'];
        $follow->username = $data['username'];
        $follow->muted = "no";
        $follow->blocked = "no";
        $follow->save();

        /* User should follow @blackmusic */
        $follow = new Follow;
        $follow->followed = '@blackmusic';
        $follow->username = $data['username'];
        $follow->muted = "no";
        $follow->blocked = "no";
        $follow->save();

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            /* 'password' => Hash::make($data['password']), */
            'password' => Hash::make($data['phone']),
            'remember_token' => $data['remember_token'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'acc_type' => $data['acc_type'],
            'acc_type_2' => $data['acc_type_2'],
            'pp' => $data['pp'],
            'pb' => $data['pb'],
            'bio' => $data['bio'],
            'dob' => $data['dob'],
            'location' => $data['location'],
            'withdrawal' => $data['withdrawal'],
        ]);
    }
}
