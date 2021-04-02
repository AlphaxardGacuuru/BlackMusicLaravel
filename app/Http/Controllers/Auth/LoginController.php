<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'posts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($website)
    {
        return Socialite::driver($website)->redirect();
    }

    // Change identifier to phone
    public function username()
    {
        return 'phone';
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($website)
    {
        $user = Socialite::driver($website)->stateless()->user();
        /* set cookie for 30 days */
        // $cookie_time = time() + (86400);
        // setcookie("name", $user->getName(), $cookie_time, "/");
        // setcookie("email", $user->getEmail(), $cookie_time, "/");
        // return view('auth.social')->with(['name' => $_COOKIE['name'], 'email' => $_COOKIE['email']]);

        // $emailCheck = User::where('email', $user->getEmail())->first();
        // $usernameCheck = User::where('email', $user->getEmail())->first()->username;
        // if ($usernameCheck) {
        //     /* Login if user is found in database */
        //     Auth::login($emailCheck);
        //     return redirect('posts');
        // } else {
        //     $try = "two";
        //     return view('auth.login')->with(['try' => $try, 'gotEmail' => $user->getEmail()]);
        // }
    }
}
