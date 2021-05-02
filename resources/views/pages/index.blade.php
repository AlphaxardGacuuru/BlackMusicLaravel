@extends('layouts/app')

@section('content')
@include('inc/topnav')
{{-- defining user --}}
@guest
    @php
        class Fruit {
        /* Guest properties */
        public $name = 'Guest';
        public $username = '@guest';
        public $email;
        public $phone;
        public $gender;
        public $account_type = 'normal';
        public $account_type_2;
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

@if($user->account_type == 'musician')
    <a href="posts/create" id="floatBtn">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pen"
            viewBox="0 0 16 16">
            <path
                d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
        </svg>
    </a>
@endif

<br>
<br class="hidden">
<br class="hidden">

<!-- Profile info area -->
<div class="row">
    <div class="col-sm-1 hidden"></div>
    <div class="col-sm-3 hidden">
        <div class="d-flex p-2 border">
            <div class="p-2 flex-fill">
                <div class="avatar-thumbnail-sm" style="border-radius: 50%;">
                    <a href='/home/{{ $user->username }}'>
                        <img src='/storage/{{ $user->pp }}' width="100px" height="100px" alt='avatar'>
                    </a>
                </div>
            </div>
            <div class="p-2 flex-fill">
                <h5 style='width: 160px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                    {{ $user->name }}
                </h5>
                <h6 style='width: 140px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                    <small>{{ $user->username }}</small>
                </h6>
                <span style='color: gold;'>
                    <svg class="bi bi-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    </svg>
                </span>
                <span style='font-size: 10px;'>
                    @auth{{ $user->decos->count() }}@endauth
                </span>
            </div>
        </div>
        <div class="d-flex p-2 border-bottom border-left border-right">
            <div class="flex-fill">
                <h6>Posts</h6>
            </div>
            <div class="flex-fill">
                <a href='fans.php'>
                    <h6>Fans</h6>
                    @auth
                        {{ $follows->where('followed', $user->username)->count() - 1 }}
                    @endauth
                </a>
            </div>
        </div>
        <!-- Profile info area End -->
        <br>
        <!-- Musician suggestions area -->
        <div class="border">
            <div class="p-2 border-bottom">
                <h2>Musicians to follow</h2>
            </div>
            @foreach($users as $musician)
                @if($musician->account_type == 'musician')
                    @php
                        $followQuery = $follows->where('followed', $musician->username)->where('username',
                        $user->username)->count();
                        $boughtVideosQuery = $boughtVideos->where('username',
                        $user->username)->where('artist', $musician->username)->count();
                        if($followQuery == 0) {
                        if($boughtVideosQuery > 0 || $user->username == '@blackmusic') {
                        $fBtn =
                        Form::submit('follow', ['class' => 'mysonar-btn float-right']);
                        } else {
                        $fBtn = Form::button('follow', ['class' => 'mysonar-btn float-right', 'onclick' =>
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
                        ['type' => 'submit', 'class' => 'btn btn-default float-right', 'style' => 'height: 33px;']);
                        }
                    @endphp
                    @if($musician->username != $user->username
                        && $musician->username != '@blackmusic')
                        <div class='media p-2 border-bottom'>
                            <div class='media-left'>
                                <a href='/home/{{ $musician->username }}'>
                                    <img src='/storage/{{ $musician->pp }}'
                                        style='float: right; vertical-align: top; width: 30px; height: 30px; border-radius: 50%;'
                                        alt='avatar'>
                                </a>
                            </div>
                            <div class='media-body'>
                                {!!Form::open(['action' => 'FollowsController@store', 'method'
                                => 'POST'])!!}
                                <b>{{ $musician->name }}</b>
                                <small><i>{{ $musician->username }}</i></small>
                                {{ Form::hidden('musician', $musician->username) }}
                                {{ $fBtn }}
                                {!!Form::close()!!}
                            </div>

                            <!-- The actual snackbar for following message -->
                            <div id='checker'>You must have bought atleast 1 song by that Musician</div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>

        <!-- The actual snackbar for following message -->
        <div id='checker'>You must have bought atleast 1 song by that Musician</div>
    </div>
    <!-- Musician suggestion area end -->

    <div class="col-sm-4">
        <!-- ****** Songs Area ****** -->
        <div class="p-2 border-bottom">
            <h5>Songs for you</h5>
            <div class="hidden-scroll">
                @if(count($videos) > 0)
                    @foreach($videos as $video)
                        @php
                            /* Check if song is in cart */
                            $cartVideoQuery = $cartVideos->where('video_id',
                            $video->id)->where('username', $user->username)->count();
                            /* Check if song is bought */
                            $boughtVideoQuery = $boughtVideos->where('username',
                            $user->username)->where('video_id', $video->id)->count();
                        @endphp
                        @if($cartVideoQuery > 0)
                            @php
                                $cart = Form::button("
                                <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16'
                                    fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd'
                                        d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                                </svg>",
                                ['class' => 'btn btn-light mb-1', 'style' => 'min-width:90px; height: 33px;']);
                                $bbtn = Form::submit("buy", ['class' => 'btn mysonar-btn green-btn']);
                            @endphp
                        @else
                            @if($boughtVideoQuery > 0)
                                @php
                                    $cart = "";
                                    $bbtn = Form::button("Owned
                                    <svg class='bi bi-check' width='1em' height='1em' viewBox='0 0 16 16'
                                        fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                        <path fill-rule='evenodd'
                                            d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
                                    </svg>",
                                    ['class' => 'btn btn-sm btn-light']);
                                @endphp
                            @else
                                @php
                                    $cart = Form::button("
                                    <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16'
                                        fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                        <path fill-rule='evenodd'
                                            d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                                    </svg>",
                                    ['type' => 'submit', 'class' => 'mysonar-btn mb-1']);
                                    $bbtn = Form::submit("buy", ['class' => 'btn mysonar-btn green-btn']);
                                @endphp
                            @endif
                        @endif
                        @if($boughtVideoQuery == 0
                            && $video->username != $user->username)
                            <span class="card pt-0 pl-0 pr-0 pb-2" style='border-radius: 10px'>
                                <div class="thumbnail"
                                    style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <a href='/video-charts/{{ $video->id }}'>
                                        <img src='{{ $video->thumbnail }}' width="160em" height="90em">
                                    </a>
                                </div>
                                <h6 class="pt-2 pr-1 pl-1 pb-0 m-0"
                                    style='width: 150px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                    {{ $video->name }}
                                </h6>
                                <h6 style='margin: 0px 5px 0px 5px; padding: 0px 5px 0px 5px;'>
                                    <small>{{ $video->username }} {{ $video->ft }}</small>
                                </h6>
                                <h6>
                                    <small class="pt-2 pr-1 pl-1 pb-0 m-0">
                                        {{ $video->bought_videos->count() }} Downloads
                                    </small>
                                </h6>
                                {{-- Add song to cart --}}
                                {!!Form::open(['action' => 'CartVideosController@store',
                                'method' => 'POST'])!!}
                                {{ Form::hidden('cart-video-song', $video->id) }}
                                {{ Form::hidden('to', 'posts') }}
                                {{ $cart }}
                                {!!Form::close()!!}
                                {{-- Buy song --}}
                                {!!Form::open(['action' => 'CartVideosController@store',
                                'method' => 'POST'])!!}
                                {{ Form::hidden('cart-video-song', $video->id) }}
                                {{ Form::hidden('to', 'cart') }}
                                {{ $bbtn }}
                                {!!Form::close()!!}
                            </span>
                        @endif
                    @endforeach
                @endif
                <br>
                <br>
            </div>
        </div>
        <!-- ****** Songs Area End ****** -->

        <!-- Posts area -->
        @if(count($posts) > 0)
            @foreach($posts as $post)
                {{-- Likes --}}
                @php
                    $postLikes = $post->post_likes->where('post_id', $post->id)->where('username',
                    $user->username)->count();
                @endphp
                @if($postLikes > 0)
                    @php
                        $heartForm = "post-like-delete-form";
                        $heart ="<span style='color: #cc3300;'>
                            <svg xmlns='http://www.w3.org/2000/svg' width=1.2em height=1.2em fill='currentColor'
                                class='bi bi-heart-fill' viewBox='0 0 16 16'>
                                <path fill-rule='evenodd'
                                    d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z' />
                            </svg>
                            <small>" . $post->post_likes->count() . "</small>
                        </span>";
                    @endphp
                @else
                    @php
                        $heartForm = "post-like-form";
                        $heart = "
                        <svg xmlns='http://www.w3.org/2000/svg' width='1.2em' height='1.2em' fill='currentColor'
                            class='bi bi-heart' viewBox='0 0 16 16'>
                            <path
                                d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z' />
                        </svg>
                        <small>" . $post->post_likes->count() . "</small>";
                    @endphp
                @endif
                @php
                    $followCount = $follows->where('followed', $post->username)->where('username',
                    $user->username)->count();
                    /* Get polls */
                    $getPolls = $polls->where('post_id', $post->id);
                    /* Get total polls */
                    $pollTime = (time() - strtotime($post->created_at)) / 3600;
                    if ($post->username == $user->username || $pollTime > 24) {
                    $votes = $polls->where('post_id', $post->id)->count();
                    } else {
                    $votes = "ongoing...";
                    }
                    /* Check if user has voted */
                    $userPoll = $polls->where('post_id', $post->id)->where('username', $user->username);
                @endphp
                {{-- Making the polls look better when they appear --}}
                {{-- Get parameter 1 --}}
                @if(!empty($post->parameter_1))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_1)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->username == $user->username || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('username',
                        $user->username)->where('parameter', $post->parameter_1)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() * 100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_1 = Form::button($post->parameter_1,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_1 = Form::button($post->parameter_1,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_1 = Form::button($post->parameter_1,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->username == $user->username) {
                                $parameter_1 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_1 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_1 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 2 --}}
                @if(!empty($post->parameter_2))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_2)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->username == $user->username || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('username',
                        $user->username)->where('parameter', $post->parameter_2)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() * 100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_2 = Form::button($post->parameter_2,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_2 = Form::button($post->parameter_2,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_2 = Form::button($post->parameter_2,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->username == $user->username) {
                                $parameter_2 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_2 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_2 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 3 --}}
                @if(!empty($post->parameter_3))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_3)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->username == $user->username || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('username',
                        $user->username)->where('parameter', $post->parameter_3)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() * 100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_3 = Form::button($post->parameter_3,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_3 = Form::button($post->parameter_3,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_3 = Form::button($post->parameter_3,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->username == $user->username) {
                                $parameter_3 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_3 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_3 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 4 --}}
                @if(!empty($post->parameter_4))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_4)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->username == $user->username || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('username',
                        $user->username)->where('parameter', $post->parameter_4)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() * 100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_4 = Form::button($post->parameter_4,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_4 = Form::button($post->parameter_4,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_4 = Form::button($post->parameter_4,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->username == $user->username) {
                                $parameter_4 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_4 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_4 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Get parameter 5 --}}
                @if(!empty($post->parameter_5))
                    @php
                        $pollCheck = $polls->where('post_id', $post->id)->where('parameter',
                        $post->parameter_5)->count();
                        $pollTime = (time() - strtotime($post->created_at)) / 3600;
                        if ($post->username == $user->username || $pollTime > 24) {
                        $votesTwo = $pollCheck;
                        } else {
                        $votesTwo = "";
                        }
                        $pollParaCheck = $polls->where('post_id', $post->id)->where('username',
                        $user->username)->where('parameter', $post->parameter_5)->count();
                        if ($pollCheck > 0) {
                        $percentage = round($pollCheck / $polls->where('post_id', $post->id)->count() * 100);
                        } else {
                        $percentage = 0;
                        }
                    @endphp
                    {{-- Condition to show user's vote after poll expiry --}}
                    @if($pollParaCheck == 1 && $pollTime > 24)
                        @php
                            $yourVote = "gold";
                        @endphp
                    @else
                        @php
                            $yourVote = "#232323";
                        @endphp
                    @endif
                    {{-- Check if user already voted and change the vote button accordingly --}}
                    @if($userPoll->count() == 0 && $pollTime < 24)
                        @php
                            $parameter_5 = Form::button($post->parameter_5,
                            ['type' => 'submit', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                            100%;']);
                        @endphp
                    @else
                        {{-- Check if user has voted for this parameter in particular and change vote button accordingly --}}
                        @if($pollParaCheck == 1 && $pollTime < 24)
                            @php
                                $parameter_5 = Form::button($post->parameter_5,
                                ['type' => 'reset', 'class' => 'mysonar-btn mb-1 btn-2', 'style' => 'width:
                                100%;']);
                            @endphp
                        @else
                            @if($pollTime < 24)
                                @php
                                    $parameter_5 = Form::button($post->parameter_5,
                                    ['type' => 'reset', 'class' => 'mysonar-btn mb-1', 'style' => 'width:
                                    100%;']);
                                @endphp
                            @endif
                            @php
                                if( $pollTime > 24 || $post->username == $user->username) {
                                $parameter_5 =
                                "<div class='progress rounded-0 mb-1' style='height: 33px'>
                                    <div class='progress-bar' style='width: $percentage%; background-color: $yourVote'>
                                        $post->parameter_5 - $percentage%
                                    </div>
                                </div>";
                                }
                            @endphp
                        @endif
                    @endif
                    @php
                        $totalVotes = "<small><i style='color: grey;'>Total votes:$votes</i></small>";
                    @endphp
                @else
                    @php
                        $parameter_5 = "";
                        $totalVotes = "";
                    @endphp
                @endif

                {{-- Check if user has followed poster --}}
                @if($followCount == 1)
                    <div class='media p-2 border-bottom'>
                        <div class='media-left'>
                            <div class="avatar-thumbnail-xs" style="border-radius: 50%;">
                                <a href='/home/{{ $post->username }}'>
                                    <img src='/storage/{{ $post->user->pp }}' width="40px" height="40px"
                                        alt='avatar'>
                                </a>
                            </div>
                        </div>
                        <div class='media-body'>
                            <h6 class="media-heading m-0"
                                style='width: 100%; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                <b>{{ $post->user->name }}</b><small>{{ $post->username }}</small>
                                <span style='color: gold;'>
                                    <svg class="bi bi-circle" width="1em" height="1em" viewBox="0 0 16 16"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    </svg>
                                </span>
                                <span style='font-size: 10px;'>{{ $post->user->deco }}</span>
                                <small>
                                    <i
                                        class="float-right mr-1">{{ $post->created_at->format('j-M-Y') }}</i>
                                </small>
                            </h6>
                            <p class="mb-0">
                                {{ $post->text }}
                            </p>
                            {{-- Show media --}}
                            @if(!empty($post->media))
                                <div class="mb-1" style="border-top-left-radius: 10px; border-top-right-radius: 10px;
                                    border-bottom-right-radius: 10px; border-bottom-left-radius: 10px; overflow:
                                    hidden;">
                                    <img src="/storage/{{ $post->media }}" alt="" width="100%" height="auto">
                                </div>
                            @endif
                            {{-- Poll --}}
                            @if(!empty($post->parameter_1))
                                {{-- Parameter 1 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_1 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_1) }}
                                {!!Form::close()!!}
                                {{-- Parameter 2 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_2 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_2) }}
                                {!!Form::close()!!}
                                {{-- Parameter 3 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_3 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_3) }}
                                {!!Form::close()!!}
                                {{-- Parameter 4 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_4 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_4) }}
                                {!!Form::close()!!}
                                {{-- Parameter 5 --}}
                                {!!Form::open(['action' => 'PollsController@store', 'method' => 'POST'])!!}
                                {!! $parameter_5 !!}
                                {{ Form::hidden('post-id', $post->id) }}
                                {{ Form::hidden('parameter', $post->parameter_5) }}
                                {!! $totalVotes !!}
                                {!!Form::close()!!}
                            @endif

                            {{-- Likes --}}
                            {!!Form::open(['id' => $post->id, 'action' => 'PostLikesController@store',
                            'method' => 'POST'])!!}
                            {{ Form::hidden('post-id', $post->id) }}
                            {!!Form::close()!!}
                            <a href='#' onclick='event.preventDefault();
													 document.getElementById("{{ $post->id }}").submit();'>
                                {!!$heart!!}
                            </a>
                            {{-- Comment --}}
                            <a href="posts/{{ $post->id }}">
                                <svg class="bi bi-chat ml-5" width="1.2em" height="1.2em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                </svg>
                                <small>{{ $post->post_comments->count() }}</small>
                            </a>
                            <!-- Default dropup button -->
                            <div class="dropup float-right">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <svg class="bi bi-three-dots-vertical" width="1em" height="1em" viewBox="0 0 16 16"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-0" style="border-radius: 0;">
                                    @php
                                        $postD = 'post-delete-form' . $post->id;
                                    @endphp
                                    @if($post->username != $user->username)
                                        @if($post->username
                                            != '@blackmusic')
                                            <a href='#' class="dropdown-item">
                                                <h6>Mute</h6>
                                            </a>
                                            <a href='#' class="dropdown-item">
                                                <h6>Unfollow {{ $post->username }}</h6>
                                            </a>
                                        @endif
                                    @else
                                        {!!Form::open(['id' => $postD, 'action' => ['PostsController@destroy',
                                        $post->id], 'method' => 'POST'])!!}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {!!Form::close()!!}
                                        <a href='#' class="dropdown-item" onclick='event.preventDefault();
													 document.getElementById("{{ $postD }}").submit();'>
                                            <h6>Delete post</h6>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <!-- Posts area end -->

    <!-- Song suggestion area -->
    <div class="col-sm-3 hidden">
        <div class="p-2 border-bottom">
            <h5>Songs to watch</h5>
        </div>
        @if(count($videos) > 0)
            @foreach($videos as $video)
                @php
                    /* Check if song is in cart */
                    $cartVideoQuery = $cartVideos->where('video_id', $video->id)->where('username',
                    $user->username)->count();
                    /* Check if song is bought */
                    $boughtVideoQuery = $boughtVideos->where('username',
                    $user->username)->where('video_id', $video->id)->count();
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
                @if($boughtVideoQuery == 0
                    && $video->username != $user->username)
                    <div class="media p-2 border-bottom">
                        <div class="media-left thumbnail">
                            <a href='/video-charts/{{ $video->id }}'>
                                <img src='{{ $video->thumbnail }}' width="160em" height="90em">
                            </a>
                        </div>
                        <div class="media-body ml-2">
                            <h6 class="m-0"
                                style='width: 150px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                {{ $video->name }}</h6>
                            <h6 class="m-0">
                                <small>{{ $video->username }} {{ $video->ft }}</small>
                            </h6>
                            <h6>
                                <small class="m-0">
                                    {{ $video->bought_videos->count() }} Downloads
                                </small>
                            </h6>
                            {{-- Add song to cart --}}
                            {!!Form::open(['id' => 'video-cart-form' . $video->id, 'action' =>
                            'CartVideosController@store',
                            'method' => 'POST'])!!}
                            {{ Form::hidden('cart-video-song', $video->id) }}
                            {{ Form::hidden('to', 'posts') }}
                            {!!Form::close()!!}
                            {{-- Buy song --}}
                            {!!Form::open(['id' => 'video-buy-form' . $video->id, 'action' =>
                            'CartVideosController@store',
                            'method' => 'POST'])!!}
                            {{ Form::hidden('cart-video-song', $video->id) }}
                            {{ Form::hidden('to', 'cart') }}
                            {!!Form::close()!!}
                            <a href='#' style="color: #000;" onclick='event.preventDefault();
													 document.getElementById("{{ 'video-cart-form' . $video->id }}").submit();'>
                                {!! $cart !!}
                            </a>
                            <a href='#' style="color: #000;" onclick='event.preventDefault();
													 document.getElementById("{{ 'video-buy-form' . $video->id }}").submit();'>
                                {!! $bbtn !!}
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        <!-- End of Song Suggestion Area -->

    </div>
    <div class="col-sm-1"></div>
</div>

@include('inc/bottomnav')
@endsection
