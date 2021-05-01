@extends('layouts/app')

@section('content')
@include('inc/topnav')
<br>
<br class="hidden">
@guest
    @php
        class Fruit {
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

        $user = new Fruit();
    @endphp
@else
    @php
        $user = Auth::user();
    @endphp
@endguest
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css' />
<div class="background"></div>
<div class="container"></div>
<div class="container">
    <div class="navbar">
        <span class="left">
            <a href="#" title="Back"><i class="fa fa-arrow-left"></i></a>
        </span>
        <span class="right">
            <a href="#" title="Like"><i class="fa fa-heart-o"></i></a>
            <a href="#" title="View More"><i class="fa fa-plus"></i></a>
        </span>
    </div>
    <div class="clearfix"></div>
    <div class="content">
        <div class="album-info">
            <figure class="disco">
                <div class="disco-cover"></div>
                <div class="disco-vinil">
                    <div class="disco-center"></div>
                </div>
            </figure>
            <div class="album-music">
                <h1 id="track_name">Time<h1>
            </div>
            <div class"album-artist">
                <h6 id="track_artist">Pink Floyd</h6>
            </div>
        </div>

        <div class="player">
            <div id="track_time" class="track-time left">00:00</div>
            <div id="track_duration" class="track-duration right">06:49</div>
            <div class="player-status">

                <div class="status-progress" style="width: 0%;">
                    <div class="status-pointer"></div>
                </div>
            </div>
            <div class="player-buttons">
                <a href="#" id="repeat_track" title="Repeat"><i class="fa fa-repeat"></i></a>
                <a href="#" title="Back" class="prev-track"><i class="fa fa-backward"></i></a>
                <a href="#" title="Pause" class="play-pause pause-active">
                    <i class="fa fa-pause"></i>
                    <i class="fa fa-play"></i>
                </a>
                <a href="#" title="Next" class="next-track"><i class="fa fa-forward"></i></a>
                <a href="#" id="random_track" title="Random"><i class="fa fa-random"></i></a>
            </div>
        </div>
    </div>
</div>
</div>
@include('inc/bottomnav')
@endsection
