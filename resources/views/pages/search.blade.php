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
@include('inc/topnav')

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
