@php
    use App\Notifications;
    use App\DecoNotifications;
    use App\FollowNotifications;
    use App\VideoNotifications;
@endphp
@guest
    @php
        class topnavGuest {
        /* Guest properties */
        public $name = 'Guest';
        public $username = '@guest';
        public $email;
        public $phone;
        public $gender;
        public $acc_type = 'normal';
        public $acc_type_2;
        public $pp = 'profile-pics/male_avatar.png';
        public $pb;
        public $bio;
        public $dob;
        public $decos = [1];
        public $location;
        public $withdrawal;
        }

        $user = new topnavGuest();
    @endphp
@else
    @php
        $user = Auth::user();
    @endphp
@endguest
@extends('layouts/app')
@section('content')

<!-- ***** Main Menu Area Start ***** -->
<div class="mainMenu d-flex align-items-center justify-content-between">
    <!-- Close Icon -->
    <div class="closeIcon">
        <i class="ti-close" aria-hidden="true"></i>
    </div>
    <!-- Logo Area -->
    <div class="logo-area">
        <a href="/posts">Black Music</a>
    </div>
    <!-- Nav -->
    <div class="sonarNav wow fadeInUp" data-wow-delay="1s">
        <nav>
            <ul>
                <li class='nav-item active'>
                    <a href='/posts' class='nav-link' style='color:<?php if(Route::is('posts.index')){echo 'gold';}?>;'>
                        <span style=' float: left; padding-right: 20px;'>
                            <svg class="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                <path fill-rule="evenodd"
                                    d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                            </svg>
                        </span>
                        Home
                    </a>
                </li>
                <li class='nav-item active'>
                    <a href='/charts/newlyReleased/All' class='nav-link'
                        style='color:<?php if(Route::is('charts.index')){echo 'gold';}?>;'>
                        <span style='float: left; padding-right: 20px;'>
                            <svg class="bi bi-compass" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 15.016a6.5 6.5 0 1 0 0-13 6.5 6.5 0 0 0 0 13zm0 1a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z" />
                                <path
                                    d="M6 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1zm.94 6.44l4.95-2.83-2.83 4.95-4.95 2.83 2.83-4.95z" />
                            </svg>
                        </span>
                        Discover
                    </a>
                </li>
                <li class='nav-item active'>
                    <a href='/library' class='nav-link'
                        style='color:<?php if(Route::is('library.index')){echo 'gold;';}?>;'>
                        <span style='float: left; padding-right: 20px;'>
                            <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            </svg>
                        </span>
                        Library
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <br>
    <!-- Copwrite Text -->
    <div class="copywrite-text">
        <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
                document.write(new Date().getFullYear());

            </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i>
            by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
    </div>
</div>
<!-- ***** Main Menu Area End ***** -->

<!-- ***** Header Area Start ***** -->
<header style="background-color: #232323;" class="header-area hidden">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12" style="padding: 0;">
                <div class="menu-area d-flex justify-content-between">
                    <!-- Logo Area  -->
                    <div class="logo-area">
                        <a href="/posts">Black Music</a>
                    </div>

                    {{-- Contact form --}}
                    <div class="contact-form hidden">
                        {!! Form::open(['action' => 'SearchController@store', 'method' => 'POST'])
                        !!}
                        {{ Form::text('search', $keyword, ['class' =>
                        'form-control', 'placeholder' => 'Search songs and artists', 'style' => 'text-color: white;
                        color: white; width: 400px;']) }}
                        {{-- {{ Form::button('search', ['class' => 'mysonar-btn float-right', 'style' => 'display: inline;']) }}
                        --}}
                        {!! Form::close() !!}
                    </div>

                    <div class="menu-content-area d-flex align-items-center">
                        <!-- Header Social Area -->
                        <div class="header-social-area d-flex align-items-center">

                            <a href="/cart" class="hidden dropbtn">
                                <svg class="bi bi-cart3" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                            </a>
                            <div class="dropdown">
                                <a class='dropbtn' data-toggle='tooltip' data-placement='bottom'
                                    onclick="bellFunction()">
                                    <svg class="bi bi-bell" width="1em" height="1em" viewBox="0 0 16 16"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                        <path fill-rule="evenodd"
                                            d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                    </svg>
                                </a>
                                <div id="bellDropdown" class="dropdown-content dropdown-notification">
                                    <div class='p-2 border-bottom'>
                                        <h4>Notifications</h4>
                                    </div>
                                    <div style="max-height: 500px; overflow-y: scroll;">
                                        @php
                                            /* Get all notifications */
                                            $notifications = Notifications::where('username',
                                            $user->username)->get();
                                            $decoNotifications = DecoNotifications::where('username',
                                            $user->username)->get();
                                            $followNotifications = FollowNotifications::where('username',
                                            $user->username)->get();
                                            $videoNotifications = VideoNotifications::where('username',
                                            $user->username)->get();
                                        @endphp
                                        {{-- Notifications --}}
                                        @foreach($notifications as $notification)
                                            <div class='p-2 border-bottom'>
                                                <a href='musicianpage.php?username=@blackmusic&bmn_id=$bmn_id'
                                                    style='padding: 10px;'>
                                                    <h6>{{ $notification->message }}</h6>
                                                </a>
                                            </div>
                                        @endforeach

                                        {{-- Deco Notifications --}}
                                        @foreach($decoNotifications as $decoNotification)
                                            <div class='p-2 border-bottom'>
                                                <a href='musicianpage.php?dn_from=$dn_from' style='padding: 10px;'>
                                                    <p>
                                                        <small>{{ $decoNotification->dn_from }}</small>
                                                        <span style='color: purple;'>just Decorated
                                                        </span><small>you.</small>
                                                    </p>
                                                </a>
                                            </div>
                                        @endforeach

                                        {{-- Follow Notifications --}}
                                        @if($followNotifications->count() > 0)
                                            <div class='p-2 border-bottom'>
                                                <a style='color: purple;' href='#'>
                                                    <h5 style='color: purple;'>New Fans</h5>
                                                </a>
                                            </div>
                                        @endif
                                        @foreach($followNotifications as $followNotification)
                                            <div class='p-2 border-bottom'>
                                                <a href='fanpage.php?fn_follower=$fn_follower' style='padding: 10px;'>
                                                    <p>
                                                        <small>{{ $followNotification->fn_follower }}</small>
                                                        <span style='color: purple;'>became a fan</span>
                                                    </p>
                                                </a>
                                            </div>
                                        @endforeach

                                        {{-- Video Notifications --}}
                                        @if($videoNotifications->count() > 0)
                                            <div class='p-2 border-bottom'>
                                                <a style='color: purple;' href='#'>
                                                    <h5 style='color: purple;'>Songs Bought</h5>
                                                </a>
                                            </div>
                                        @endif
                                        @foreach($videoNotifications as $videoNotification)
                                            <div class='p-2 border-bottom'>
                                                <a href='fanpage.php?vsn_buyer=$vsn_buyer' style='padding: 10px;'>
                                                    <p>
                                                        <small>{{ $videoNotification->vsn_buyer }}</small>
                                                        <span style='color: purple;'>just bought</span>
                                                        <small>{{ $videoNotification->video_id }}</small>
                                                    </p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <a href="">
                                <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg>
                            </a>
                            <!-- Authentication Links -->
                            @guest
                                <a class="display-4"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if(Route::has('register'))
                                    <a class="display-4"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else

                                <!-- avatar dropdown -->
                                <div class="dropdown">
                                    <a class="dropbtn" aria-hidden="true">
                                        <img style='vertical-align: middle; width: 25px; height: 25px; border-radius: 50%;'
                                            src='/storage/{{ Auth::user()->pp }}' alt='Avatar' class='dropbtn'
                                            onclick='avatarFunction()'>
                                    </a>
                                    <div id="avatarDropdown" style="right: 1px;" class="dropdown-content">
                                        <div class='myrow' style="padding: 0px; margin: 0;">
                                            <a href="/home/{{ Auth::user()->username }}" style='padding: 10px;'>
                                                <h5>{{ Auth::user()->name }}</h5>
                                                <h6>{{ Auth::user()->username }}</h6>
                                            </a>
                                        </div>
                                        <div class='myrow' style='padding: 0px; margin: 0;'>
                                            <a href='/videos' style='padding: 10px;'>
                                                <h6>Studio</h6>
                                            </a>
                                        </div>
                                        <div class='myrow' style="padding: 0px; margin: 0;">
                                            <a href="/home/create" style='padding: 10px;'>
                                                <h6>Settings</h6>
                                            </a>
                                        </div>
                                        <div class='myrow' style="padding: 0px; margin: 0;">
                                            <a href="help.php" style='padding: 10px;'>
                                                <h6>Help Centre</h6>
                                            </a>
                                        </div>
                                        <div class='myrow' style="padding: 0px; margin: 0;">
                                            <a href="{{ route('logout') }}" style='padding: 10px;'
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <h6>{{ __('Sign out') }}</h6>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endguest
                        </div>
                        <!-- Menu Icon -->
                        <span class="navbar-toggler-icon hidden" id="menuIcon"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- For mobile --}}
<!-- ***** Header Area Start ***** -->
<header style="background-color: #232323;" class="header-area anti-hidden">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12" style="padding: 0;">

                {{-- Contact form --}}
                <div class="contact-form">
                    {!! Form::open(['action' => 'SearchController@store', 'method' => 'POST'])
                    !!}
                    {{ Form::text('search', $keyword, ['id' => 'search', 'class' =>
                        'form-control', 'placeholder' => 'Search songs and artists', 'style' => 'color: white;
                        width: 100%;']) }}
                    {{-- {{ Form::button('search', ['class' => 'mysonar-btn float-right', 'style' => 'display: inline;']) }}
                    --}}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</header>
<br>
<br>
<br>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <!-- ****** Artists Area Start ****** -->
        <br>
        @if($results->count() > 0)
            <h5>Artists</h5>
            <div class="hidden-scroll border-bottom">
                @foreach($results as $result)
                    @php
                        $followQuery = $follows->where('followed', $result)->where('username',
                        Auth::user()->username)->count();
                        $boughtVideosQuery = $boughtVideos->where('username',
                        Auth::user()->username)->where('bought_video_artist', $result)->count();
                        if ($followQuery == 0) {
                        if ($boughtVideosQuery > 0 || Auth::user()->username == '@blackmusic') {
                        $fBtn =
                        Form::submit('follow', ['class' => 'mysonar-btn float-right']);
                        } else {
                        $fBtn = Form::button('follow', ['class' => 'mysonar-btn', 'onclick' =>
                        'checkerSnackbar()']);
                        }
                        } else {
                        $fBtn = Form::button("
                        Followed
                        <svg class='bi bi-check' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
                        </svg>",
                        ['type' => 'submit', 'class' => 'btn btn-light']);
                        }
                    @endphp
                    @if($result->username != $user->username
                        && $result->username != '@blackmusic')
                        <span class="pt-0 pl-0 pr-0 pb-2" style='border-radius: 10px'>
                            <center>
                                <div class="card avatar-thumbnail" style="border-radius: 50%;">
                                    <a href='/home/{{ $result->username }}'>
                                        <img src="/storage/{{ $result->pp }}" width='150px' height='150px' alt=''>
                                    </a>
                                </div>
                                <h6 class="p-0 m-0"
                                    style='width: 100px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                    {{ $result->name }}</h6>
                                <h6 class="p-0 mt-0 mr-0 ml-0"
                                    style='width: 100px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                    <small>{{ $result->username }}</small>
                                </h6>
                            </center>
                        </span>
                    @endif

                    <!-- The actual snackbar for following message -->
                    <div id='checker'>You must have bought atleast 1 song by that Musician</div>
                @endforeach
            </div>
        @endif
        <!-- ****** Artists Area End ****** -->
    </div>
    <div class="col-sm-4"></div>
</div>

<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-3">
        <!-- ****** Songs Area ****** -->
        @if(count($videoResults) > 0)
            @foreach($videoResults as $videoResult)
                @php
                    /* Check if song is in cart */
                    $cartVideoQuery = $cartVideos->where('video_id', $videoResult->id)->where('username',
                    $user->username)->count();
                    /* Check if song is bought */
                    $boughtVideoQuery = $boughtVideos->where('username',
                    $user->username)->where('video_id', $videoResult->id)->count();
                @endphp
                @if($cartVideoQuery > 0)
                    @php
                        $cart = "<button class='btn btn-light mb-1' style='min-width: 40px; height: 33px;'>
                            <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path fill-rule='evenodd'
                                    d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                            </svg>";
                            $bbtn = "<button class='btn mysonar-btn green-btn float-right'>buy</button>";
                    @endphp
                @else
                    @if($boughtVideoQuery > 0)
                        @php
                            $cart = "";
                            $bbtn = "<button class='btn btn-sm btn-light float-right'>Owned
                                <svg class='bi bi-check' width='1em' height='1em' viewBox='0 0 16 16'
                                    fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd'
                                        d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
                                </svg>";
                        @endphp
                    @else
                        @php
                            $cart = "<button class='mysonar-btn mb-1' style='min-width: 40px;'>
                                <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16'
                                    fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd'
                                        d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                                </svg>";
                                $cForm = "";
                                $bbtn = "<button class='btn mysonar-btn green-btn float-right'>buy</button>";
                                $dForm = "";
                        @endphp
                    @endif
                @endif
                @if($boughtVideoQuery == 0)
                    <div class="media p-2 border-bottom">
                        <div class="media-left thumbnail">
                            <a href='/charts/{{ $videoResult->id }}'>
                                <img src='{{ $videoResult->thumbnail }}' width="160em" height="90em">
                            </a>
                        </div>
                        <div class="media-body ml-2">
                            <h6 class="m-0"
                                style='width: 150px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                {{ $videoResult->name }}</h6>
                            <h6 class="m-0">
                                <small>{{ $videoResult->username }} {{ $videoResult->ft }}</small>
                            </h6>
                            <h6>
                                <small class="m-0">
                                    Downloads
                                </small>
                            </h6>
                            {{-- Add song to cart --}}
                            {!!Form::open(['id' => 'video-cart-form' . $videoResult->id, 'action' =>
                            'CartVideosController@store',
                            'method' => 'POST'])!!}
                            {{ Form::hidden('cart-video-song', $videoResult->id) }}
                            {{ Form::hidden('to', 'posts') }}
                            {!!Form::close()!!}
                            {{-- Buy song --}}
                            {!!Form::open(['id' => 'video-buy-form' . $videoResult->id, 'action' =>
                            'CartVideosController@store',
                            'method' => 'POST'])!!}
                            {{ Form::hidden('cart-video-song', $videoResult->id) }}
                            {{ Form::hidden('to', 'cart') }}
                            {!!Form::close()!!}
                            <a href='#' style="color: #000;"
                                onclick='event.preventDefault();
													 document.getElementById("{{ 'video-cart-form' . $videoResult->id }}").submit();'>
                                {!! $cart !!}
                            </a>
                            <a href='#' style="color: #000;"
                                onclick='event.preventDefault();
													 document.getElementById("{{ 'video-buy-form' . $videoResult->id }}").submit();'>
                                {!! $bbtn !!}
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        <!-- ****** Songs Area End ****** -->
    </div>
    <div class="col-sm-4"></div>
</div>
@include('inc/bottomnav')
@endsection
