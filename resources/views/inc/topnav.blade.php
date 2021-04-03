@php
    use App\Notifications;
    use App\DecoNotifications;
    use App\FollowNotifications;
    use App\VideoNotifications;
    use App\CartVideos;
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

<!-- ***** Main Menu Area Start ***** -->
<div class="mainMenu d-flex align-items-center justify-content-between">
    <!-- Close Icon -->
    <div class="closeIcon">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x"
            viewBox="0 0 16 16">
            <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
        </svg>
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
                    <a href='/video-charts/newlyReleased/All' class='nav-link'
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
</div>
<!-- ***** Main Menu Area End ***** -->

<!-- ***** Header Area Start ***** -->
<header style="background-color: #232323;" class="header-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12" style="padding: 0;">
                <div class="menu-area d-flex justify-content-between">
                    <!-- Logo Area  -->
                    <div class="logo-area">
                        <a href="/posts">Black Music</a>
                    </div>

                    @auth
                        {{-- Contact form --}}
                        <div class="contact-form hidden">
                            {!! Form::open(['action' => 'SearchController@store', 'method' => 'POST'])
                            !!}
                            {{ Form::text('search', null, ['id' => 'search', 'class' => 'form-control', 'placeholder' => 'Search songs and artists', 'style' => 'text-color: white; color: white; width: 400px;']) }}
                            {{-- {{ Form::button('search', ['class' => 'mysonar-btn float-right', 'style' => 'display: inline;']) }}
                            --}}
                            {!! Form::close() !!}
                        </div>
                    @endauth

                    <div class="menu-content-area d-flex align-items-center">
                        <!-- Header Social Area -->
                        <div class="header-social-area d-flex align-items-center">

                            <!-- Authentication Links -->
                            @guest
                                <a class="display-4"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if(Route::has('register'))
                                    <a class="display-4"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                {{-- Admin --}}
                                @if(auth()->user()->username
                                    == '@blackmusic')
                                    <a href="/admin" class="mr-2">
                                        <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        </svg>
                                    </a>
                                @endif
                                {{-- Cart Dropdown --}}
                                @php
                                    /* Get all notifications */
                                    $cartVideos = CartVideos::where('username', $user->username)->get();
                                @endphp
                                <div class="dropdown mr-2">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <svg class="bi bi-cart3" width="1em" height="1em" viewBox="0 0 16 16"
                                            fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                    </a>
                                    @if($cartVideos->count() > 0)
                                        <span class="badge badge-danger rounded-circle hidden"
                                            style="padding: 3px 5px; position: absolute; right: -3px; top: -3px; border: solid #232323">
                                            {{ $cartVideos->count() }}
                                        </span>
                                    @endif
                                    <div style="border-radius: 0;" class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item border-bottom" href="#">
                                            <h4>Shopping Cart</h4>
                                        </a>
                                        <div style="max-height: 500px; overflow-y: scroll;">
                                            @if($cartVideos->count() > 0)
                                                @foreach($cartVideos as $cartVideo)
                                                    <div class='media p-2 border-bottom'>
                                                        <div class='media-left thumbnail'>
                                                            <a href='/video-charts/{{ $cartVideo->video_id }}'>
                                                                <img src='{{ $cartVideo->videos->thumbnail }}'
                                                                    width="160em" height="90em">
                                                            </a>
                                                        </div>
                                                        <div class='media-body ml-2'>
                                                            <h6 class="m-0"
                                                                style='width: 160px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                                                {{ $cartVideo->videos->name }}</h6>
                                                            <h6
                                                                style='width: 140px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                                                <small>{{ $cartVideo->videos->username }}</small>
                                                            </h6>
                                                            <h6 style='color: green;'>KES 20</h6>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if($cartVideos->count() > 0)
                                                <a class="dropdown-item p-2" href="/cart">
                                                    <center>
                                                        <h6>Checkout</h6>
                                                    </center>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown mr-2">
                                    @php
                                        /* Get all notifications */
                                        $notifications = Notifications::where('username',
                                        $user->username)->get();
                                        $decoNotifications = DecoNotifications::where('username',
                                        $user->username)->get();
                                        $followNotifications = FollowNotifications::where('username',
                                        $user->username)->get();
                                        $videoNotifications = VideoNotifications::where('vn_artist',
                                        $user->username)->get();
                                        $notificationBadge = $notifications->count() + $decoNotifications->count() +
                                        $followNotifications->count() + $videoNotifications->count();
                                    @endphp
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <svg class="bi bi-bell" width="1em" height="1em" viewBox="0 0 16 16"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                            <path fill-rule="evenodd"
                                                d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                        </svg>
                                    </a>
                                    @if($notificationBadge > 0)
                                        <span class="badge badge-danger rounded-circle hidden"
                                            style="padding: 3px 5px; position: absolute; right: -3px; top: -3px; border: solid #232323">
                                            {{ $notificationBadge }}
                                        </span>
                                    @endif
                                    <div style="border-radius: 0;" class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item border-bottom" href="#">
                                            <h4>Notifications</h4>
                                        </a>
                                        <div style="max-height: 500px; overflow-y: scroll;">
                                            {{-- Notifications --}}
                                            @foreach($notifications as $notification)
                                                <div class='border-bottom'>
                                                    {!!Form::open(['id' => 'notification-form', 'action' =>
                                                    ['NotificationsController@destroy', $notification->notification_id],
                                                    'method' => 'POST'])!!}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {!!Form::close()!!}
                                                    <a href='#' class="p-2" onclick='event.preventDefault();
													 document.getElementById("notification-form").submit();'>
                                                        <h6>{{ $notification->message }}</h6>
                                                    </a>
                                                </div>
                                            @endforeach
                                            {{-- Deco Notifications --}}
                                            @foreach($decoNotifications as $decoNotification)
                                                <div class='p-2 border-bottom'>
                                                    <a href='#'>
                                                        <p>
                                                            <small>{{ $decoNotification->dn_from }} just Decorated
                                                                you.</small>
                                                        </p>
                                                    </a>
                                                </div>
                                            @endforeach
                                            {{-- Follow Notifications --}}
                                            @if($followNotifications->count() > 0)
                                                <div class='p-2 border-bottom'>
                                                    <a href='#'>
                                                        <h6 style='color: purple;'>New Fans</h6>
                                                    </a>
                                                </div>
                                            @endif
                                            @foreach($followNotifications as $followNotification)
                                                <div class='p-1 border-bottom'>
                                                    {!!Form::open(['id' => $followNotification->follow_notification_id,
                                                    'action' =>
                                                    ['FollowNotificationsController@destroy',
                                                    $followNotification->fn_follower ], 'method' => 'POST'])!!}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {!!Form::close()!!}
                                                    <a href='#' onclick='event.preventDefault();
													 document.getElementById("{{ $followNotification->follow_notification_id }}").submit();'>
                                                        <p class="m-0">
                                                            <small>{{ $followNotification->fn_follower }} became a
                                                                fan.</small>
                                                        </p>
                                                    </a>
                                                </div>
                                            @endforeach
                                            {{-- Video Notifications --}}
                                            @if($videoNotifications->count() > 0)
                                                <div class='p-1 border-bottom'>
                                                    <a href='#'>
                                                        <h6>Songs Bought</h6>
                                                    </a>
                                                </div>
                                            @endif
                                            @foreach($videoNotifications as $videoNotification)
                                                <div class='p-1 border-bottom'>
                                                    {!!Form::open(['id' => $videoNotification->vn_id,
                                                    'action' =>
                                                    ['VideoNotificationsController@destroy',
                                                    $videoNotification->vn_id ], 'method' => 'POST'])!!}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {!!Form::close()!!}
                                                    <a href='#' onclick='event.preventDefault();
													 document.getElementById("{{ $videoNotification->vn_id }}").submit();'>
                                                        <p class="m-0">
                                                            <small>{{ $videoNotification->username }} just bought
                                                                {{ $videoNotification->videos->name }}</small>
                                                        </p>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{-- Avatar Dropdown --}}
                                <div class="dropdown">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img style='vertical-align: middle; width: 25px; height: 25px; border-radius: 50%;'
                                            src='/storage/{{ Auth::user()->pp }}' alt='Avatar'>
                                    </a>
                                    <div style="border-radius: 0;" class="dropdown-menu dropdown-menu-right m-0 p-0"
                                        aria-labelledby="dropdownMenuButton">
                                        <a href="/home/{{ Auth::user()->username }}"
                                            class="p-3 dropdown-item border-bottom">
                                            <h5>{{ Auth::user()->name }}</h5>
                                            <h6>{{ Auth::user()->username }}</h6>
                                        </a>
                                        <a href='/videos' class="p-3 dropdown-item border-bottom">
                                            <h6>Studio</h6>
                                        </a>
                                        <a href="/home/create" class="p-3 dropdown-item border-bottom">
                                            <h6>Settings</h6>
                                        </a>
                                        <a href="help.php" class="p-3 dropdown-item border-bottom">
                                            <h6>Help Centre</h6>
                                        </a>
                                        <a href="{{ route('logout') }}" class="p-3 dropdown-item"
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
                            @endguest
                        </div>
                        <!-- Menu Icon -->
                        <a href="#" class="hidden" id="menuIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
