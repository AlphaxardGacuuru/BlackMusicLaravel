@component('mail::message')
    # Welcome to Black Music

    Hi there $username, welcome to Black Music. Check out your favorite musicians and support them by buying.

    {{-- @component('mail::button',
        ['url' => ''])
        Button Text
@endcomponent--}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
{{-- @extends('layouts/app')
@section('content')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <center>
            <h2>Welcome to Black Music</h2>

            <p>Hi there Auth::user()->username, welcome to Black Music. Check out your favorite musicians and support
                them
                by buying their songs.</p>
            <br>
            <a href="https://music.black.co.ke" class="btn sonar-btn">visit</a>
            <br>
            <br>
            Thanks,<br>
            Black Music
        </center>
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection--}}
