<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Change address bar color Chrome, Firefox OS and Opera --}}
    <meta name="theme-color" content="#232323" />
    {{-- iOS Safari --}}
    <meta name="apple-mobile-web-app-status-bar-style" content="#232323">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Black Music') }}</title>

    <!-- Favicon  -->
    <link rel="icon" href="storage/img/musical-note.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Filepond plugin, add to document <head> -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />

    {{-- Manifest --}}
    <link rel="manifest" type="application/manifest+json" href="manifest.webmanifest">

    {{-- IOS support --}}
    <link rel="apple-touch-icon" href="img/musical-note.png">
    <meta name="apple-mobile-web-app-status-bar" content="#aa7700">
</head>
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
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-image: linear-gradient(0deg,
                rgba(247, 247, 247, 1) 23.8%,
                rgba(252, 221, 221, 1) 92%);
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-family: 'Lato', sans-serif;
        margin: 0;
    }

    .music-container {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 20px 20px 0 rgba(252, 169, 169, 0.6);
        display: flex;
        padding: 20px 30px;
        position: relative;
        margin: 100px 0;
        z-index: 10;
    }

    .img-container {
        position: relative;
        width: 110px;
    }

    .img-container::after {
        content: '';
        background-color: #fff;
        border-radius: 50%;
        position: absolute;
        bottom: 100%;
        left: 50%;
        width: 20px;
        height: 20px;
        transform: translate(-50%, 50%);
    }

    .img-container img {
        border-radius: 50%;
        object-fit: cover;
        height: 110px;
        width: inherit;
        position: absolute;
        bottom: 0;
        left: 0;
        animation: rotate 3s linear infinite;

        animation-play-state: paused;
    }

    .music-container.play .img-container img {
        animation-play-state: running;
    }

    keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .navigation {
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .action-btn {
        background-color: #fff;
        border: 0;
        color: #dfdbdf;
        font-size: 20px;
        cursor: pointer;
        padding: 10px;
        margin: 0 20px;
    }

    .action-btn.action-btn-big {
        color: #cdc2d0;
        font-size: 30px;
    }

    .action-btn:focus {
        outline: 0;
    }

    .music-info {
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 15px 15px 0 0;
        position: absolute;
        top: 0;
        left: 20px;
        width: calc(100% - 40px);
        padding: 10px 10px 10px 150px;
        opacity: 0;
        transform: translateY(0%);
        transition: transform 0.3s ease-in, opacity 0.3s ease-in;
        z-index: 0;
    }

    .music-container.play .music-info {
        opacity: 1;
        transform: translateY(-100%);
    }

    .music-info h4 {
        margin: 0;
    }

    .progress-container {
        background: #fff;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px 0;
        height: 4px;
        width: 100%;
    }

    .progress {
        background-color: #fe8daa;
        border-radius: 5px;
        height: 100%;
        width: 0%;
        transition: width 0.1s linear;
    }

</style>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <br>
        @php
            $show = $audios->where('id', $id)->first();
        @endphp
        <h1>Music Player</h1>
        <div class="music-container">
            <div class="music-info">
                <h4 id="title">{{ $show->name }}</h4>
                <div class="progress-container">
                    <div class="progress"></div>
                </div>
            </div>

            <audio src="/storage/{{ $show->audio }}" id="audio"></audio>

            <div class="img-container">
                <img src="/storage/{{ $show->thumbnail }}" alt="music-cover" id="cover" />
            </div>

            <div class="navigation">
                <button id="prev" class="action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-skip-backward" viewBox="0 0 16 16">
                        <path
                            d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm7 1.133L1.696 8 7.5 11.367V4.633zm7.5 0L9.196 8 15 11.367V4.633z" />
                    </svg>
                </button>
                <button id="play" class="action-btn action-btn-big">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-play" viewBox="0 0 16 16">
                        <path
                            d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                    </svg>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pause" viewBox="0 0 16 16">
                        <path
                            d="M6 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm4 0a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z" />
                    </svg> --}}
                </button>
                <button id="next" class="action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-skip-forward" viewBox="0 0 16 16">
                        <path
                            d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.752l-6.267 3.636c-.52.302-1.233-.043-1.233-.696v-2.94l-6.267 3.636C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696L7.5 7.248v-2.94c0-.653.713-.998 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5zM1 4.633v6.734L6.804 8 1 4.633zm7.5 0v6.734L14.304 8 8.5 4.633z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}" defer></script>
</body>
</html>
