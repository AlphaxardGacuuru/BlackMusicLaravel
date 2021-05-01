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

<!-- Modal for Deactivating Account -->
<div id="vidShareModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Share Song</h4>
                <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <center>
                    <h5>Copy link</h5>
                    <h6>{{ 'https://music.black.co.ke/play_video.php?vsong_id=$vsong_id&referrer=$user' }}
                    </h6>
                </center>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>

<!-- <button type="button" class="sonar-btn" data-toggle="modal" data-target="#vidShareModal">share</button> -->
<br>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-7">
        <div class="resp-container">
            @php
                /* Get song and it's info */
                $show = $videos->where('id', $id)->first();
                /* Check if song is in cart */
                $cartVideoQuery = $cartVideos->where('video_id',
                $show->id)->where('username', $user->username)->count();
                /* Check if song is bought */
                $boughtVideoQuery = $boughtVideos->where('username',
                $user->username)->where('video_id', $show->id)->count();
                $videoLikes = $videoLikes->where('username', $user->username)->count()
            @endphp
            @if($boughtVideoQuery > 0
                || $show->username == $user->username
                || $user->username == "@blackmusic")
                @php
                    $cart = "";
                    $bbtn = Form::button("Owned
                    <svg class='bi bi-check' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                        xmlns='http://www.w3.org/2000/svg'>
                        <path fill-rule='evenodd'
                            d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
                    </svg>",
                    ['class' => 'btn btn-sm btn-default float-right']);
                    $share = "<a
                        href='whatsapp://send?text=https://music.black.co.ke/play_video.php?id=$id&referrer=$user->username'
                        data-action='share/whatsapp/share' class='float-right'>
                        <svg class='bi bi-reply' width='1.2em' height='1.2em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M9.502 5.013a.144.144 0 0 0-.202.134V6.3a.5.5 0 0 1-.5.5c-.667 0-2.013.005-3.3.822-.984.624-1.99 1.76-2.595 3.876C3.925 10.515 5.09 9.982 6.11 9.7a8.741 8.741 0 0 1 1.921-.306 7.403 7.403 0 0 1 .798.008h.013l.005.001h.001L8.8 9.9l.05-.498a.5.5 0 0 1 .45.498v1.153c0 .108.11.176.202.134l3.984-2.933a.494.494 0 0 1 .042-.028.147.147 0 0 0 0-.252.494.494 0 0 1-.042-.028L9.502 5.013zM8.3 10.386a7.745 7.745 0 0 0-1.923.277c-1.326.368-2.896 1.201-3.94 3.08a.5.5 0 0 1-.933-.305c.464-3.71 1.886-5.662 3.46-6.66 1.245-.79 2.527-.942 3.336-.971v-.66a1.144 1.144 0 0 1 1.767-.96l3.994 2.94a1.147 1.147 0 0 1 0 1.946l-3.994 2.94a1.144 1.144 0 0 1-1.767-.96v-.667z' />
                        </svg>
                    </a>";
                @endphp
                @if($videoLikes > 0)
                    @php
                        $vidheart = "<span class='float-right mr-3' style='color: #cc3300;'>
                            <svg class=bi bi-heart-fill width=1.2em height=1.2em viewBox=0 0 16 16 fill=currentColor
                                xmlns=http://www.w3.org/2000/svg>
                                <path fill-rule=evenodd'
                                    d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z' />
                            </svg>
                            <small>" . $show->video_likes->count() . "</small>
                        </span>";
                    @endphp
                @else
                    @php
                        $vidheart = "<span class='float-right mr-3'>
                            <svg class='bi bi-heart' width='1.2em' height='1.2em' viewBox='0 0 16 16'
                                fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                <path fill-rule='evenodd'
                                    d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z' />
                            </svg>
                            <small>" . $show->video_likes->count() . "</small>
                        </span>";
                    @endphp
                @endif
                {{-- If user has bought song show video --}}
                <iframe class='resp-iframe' width='880px' height='495px' src='{{ $show->video }}?autoplay=1'
                    frameborder='0' allow='accelerometer' ; encrypted-media; gyroscope; picture-in-picture;
                    allowfullscreen></iframe>
            @else
                @php
                    $cart = Form::button("
                    <svg class='bi bi-cart3' width='1.2em' height='1.2em' viewBox='0 0 16 16' fill='currentColor'
                        xmlns='http://www.w3.org/2000/svg'>
                        <path fill-rule='evenodd'
                            d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                    </svg>",
                    ['type' => 'submit', 'class' => 'mysonar-btn mb-1']);
                    $bbtn = Form::submit("buy", ['class' => 'btn mysonar-btn green-btn float-right', 'style' =>
                    'height: 33px;']);
                    $share ="<span class='float-right'>
                        <svg class='bi bi-reply' width='1.2em' height='1.2em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M9.502 5.013a.144.144 0 0 0-.202.134V6.3a.5.5 0 0 1-.5.5c-.667 0-2.013.005-3.3.822-.984.624-1.99 1.76-2.595 3.876C3.925 10.515 5.09 9.982 6.11 9.7a8.741 8.741 0 0 1 1.921-.306 7.403 7.403 0 0 1 .798.008h.013l.005.001h.001L8.8 9.9l.05-.498a.5.5 0 0 1 .45.498v1.153c0 .108.11.176.202.134l3.984-2.933a.494.494 0 0 1 .042-.028.147.147 0 0 0 0-.252.494.494 0 0 1-.042-.028L9.502 5.013zM8.3 10.386a7.745 7.745 0 0 0-1.923.277c-1.326.368-2.896 1.201-3.94 3.08a.5.5 0 0 1-.933-.305c.464-3.71 1.886-5.662 3.46-6.66 1.245-.79 2.527-.942 3.336-.971v-.66a1.144 1.144 0 0 1 1.767-.96l3.994 2.94a1.147 1.147 0 0 1 0 1.946l-3.994 2.94a1.144 1.144 0 0 1-1.767-.96v-.667z' />
                        </svg>
                    </span>";
                    $vidheart = "<span class='float-right mr-3'>
                        <svg class='bi bi-heart' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z' />
                        </svg>
                        <small>" . $show->video_likes->count() . "</small>
                    </span>";
                @endphp
                <iframe class='resp-iframe' width='880px' height='495px'
                    src='{{ $show->video }}?autoplay=1&end=10&controls=0' frameborder='0' allow='accelerometer' ;
                    encrypted-media; gyroscope; picture-in-picture; allowfullscreen></iframe>
            @endif
        </div>
        <div class="p-2 border-bottom">
            {!! $share !!}
            {{-- Likes --}}
            @if($boughtVideoQuery > 0
                || $show->username == $user->username
                || $user->username == "@blackmusic")
                {!!Form::open(['id' => 'video-like-form', 'action' => 'VideoLikesController@store',
                'method' => 'POST'])!!}
                {{ Form::hidden('video-id', $show->id) }}
                {!!Form::close()!!}
                <a href='#' onclick='event.preventDefault();
													 document.getElementById("video-like-form").submit();'>
                    {!! $vidheart !!}
                </a>
            @else
                {!! $vidheart !!}
            @endif
            <h6 class="m-0 p-0" style='width: 200px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                <small>Song Name</small> {{ $show->name }}</h6>
            <small>Downloads</small> <span>{{ $show->bought_videos->count() }}</span><br>
            <small>Album</small> <span>{{ $show->album }}</span><br>
            <small>Genre</small> <span>{{ $show->genre }}</span><br>
            <small>Posted</small>
            <span>{{ $show->created_at->format('j M Y') }}</span>
            {!!Form::open(['action' => 'CartVideosController@store', 'method' => 'POST'])!!}
            {{ Form::hidden('cart-video-song', $show->id) }}
            {{ Form::hidden('to', 'cart') }}
            {{ $bbtn }}
            {!!Form::close()!!}
            <br>
            <br>
        </div>
        <div class="p-2 border-bottom">
            @php
                $musician = $users->where('username', $show->username)->first();
                $followQuery = $follows->where('followed', $show->username)->where('username',
                $user->username)->count();
                $boughtVideosQuery = $boughtVideos->where('username',
                $user->username)->where('artist', $musician->username)->count();
            @endphp
            @if($followQuery == 0)
                @if($boughtVideosQuery > 0
                    || $user->username == '@blackmusic')
                    @php
                        $fBtn = Form::submit('follow', ['class' => 'mysonar-btn float-right']);
                    @endphp
                @else
                    @php
                        $fBtn = Form::button('follow', ['class' => 'mysonar-btn float-right', 'onclick' =>
                        'checkerSnackbar()']);
                    @endphp
                @endif
            @else
                @php
                    $fBtn = Form::button("
                    Followed
                    <svg class='bi bi-check' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                        xmlns='http://www.w3.org/2000/svg'>
                        <path fill-rule='evenodd'
                            d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
                    </svg>",
                    ['type' => 'submit', 'class' => 'btn btn-sm btn-default float-right']);
                @endphp
            @endif
            <div class='media'>
                <div class='media-left'>
                    <a href='/home/{{ $musician->username }}'>
                        <img src='/storage/{{ $musician->pp }}'
                            style='float: right; vertical-align: top; width: 40px; height: 40px; border-radius: 50%;'
                            alt='avatar'>
                    </a>
                </div>
                <div style='padding-left: 1%;' class='media-body'>
                    <h6 class="m-0 p-0"
                        style='width: 140px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                        <small>{{ $musician->name }} {{ $musician->username }}</small>
                    </h6>
                    <span style='color: gold; padding-top: 10px;' class='fa fa-circle-o'></span>
                    <small>{{ $musician->decos->count() }}</small>
                    <span style='font-size: 1rem;'>&#x2022;</span>
                    <small>{{ $musician->follow->count() }} fans</small>
                    {{ $fBtn }}
                </div>
            </div>

            <!-- The actual snackbar for following message -->
            <div id='checker'>You must have bought atleast 1 song by that Musician</div>
        </div>

        <!-- Read more section -->
        <div class="p-2">
            <!-- single accordian area -->
            <div class="panel single-accordion">
                <h6>
                    <a role="button" class="collapsed" aria-expanded="true" aria-controls="collapseTwo"
                        data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">read more
                        <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                    </a>
                </h6>
                <div id="collapseTwo" class="accordion-content collapse">
                    <br>
                    <h6>{{ $show->description }}</h6>
                </div>
            </div>
        </div>

        <!-- Comment Form -->
        <div class="p-2 border-bottom">
            <div class="media">
                <div class="media-left">
                    <img src='/storage/{{ $user->pp }}'
                        style='vertical-align: top; width: 30px; height: 30px; border-radius: 50%;' alt='avatar'>
                </div>
                <div class="media-body">
                    <div class="contact-form form-group">
                        @php
                            if ($boughtVideoQuery > 0 || $show->username == $user->username ||
                            $user->username == "@blackmusic") {
                            $videoTxt = Form::submit('comment', ['class' => 'mysonar-btn float-right']);
                            } else {
                            $videoTxt = Form::reset('comment', ['class' => 'mysonar-btn float-right']);
                            }
                        @endphp
                        {!! Form::open(['action' => 'VideoCommentsController@store', 'method' => 'POST']) !!}
                        {{ Form::text('video-comment-text', '', ['class' => 'form-control', 'placeholder' => "Comment on song", 'required']) }}
                        <br>
                        {{ Form::hidden('video-id', $show->id) }}
                        {{ Form::hidden('musician', $show->username) }}
                        {{ Form::submit('comment', ['class' => 'btn mysonar-btn float-right']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Comment Form -->

        <!-- Comment Section -->
        @if($boughtVideoQuery > 0
            || $show->username == $user->username
            || $user->username == "@blackmusic")
            @foreach($videoComments as $videoComment)
                @php
                    $videoCommentLikeCount = $videoCommentLikes->where('comment_id',
                    $videoComment->id)->where('username', $user->username)->count();
                @endphp
                @if($videoCommentLikeCount > 0)
                    @php
                        $heart ="<span style='color: #cc3300;'>
                            <svg class=bi bi-heart-fill width=1.2em height=1.2em viewBox=0 0 16 16 fill=currentColor
                                xmlns=http://www.w3.org/2000/svg>
                                <path fill-rule=evenodd'
                                    d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z' />
                            </svg>
                            <small>" . $videoComment->video_comment_likes->count() . "</small>
                        </span>";
                    @endphp
                @else
                    @php
                        $heart = "
                        <svg class='bi bi-heart' width='1.2em' height='1.2em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z' />
                        </svg>
                        <small>" . $videoComment->video_comment_likes->count() . "</small>";
                    @endphp
                @endif
                <div class=' media p-2 border-bottom'>
                    <div class='media-left'>
                        <a href='/home/{{ $videoComment->username }}'>
                            <img src='/storage/{{ $videoComment->user->pp }}'
                                style='float: right; vertical-align: top; width: 40px; height: 40px; border-radius: 50%;'
                                alt='avatar'>
                        </a>
                    </div>
                    <div class='media-body'>
                        <h6 class="media-heading m-0"
                            style='width: 100%; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            <b>{{ $videoComment->user->name }}</b><small>{{ $videoComment->username }}</small>
                            <span style='color: gold;'>
                                <svg class="bi bi-circle" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                </svg>
                            </span>
                            <span style='font-size: 10px;'>{{ $videoComment->user->decos->count() }}</span>
                            <small>
                                <i class="float-right
                                mr-1">{{ $videoComment->created_at->format('j-M-Y') }}</i>
                            </small>
                        </h6>
                        <p class="mb-0">
                            {{ $videoComment->text }}
                        </p>

                        {{-- Likes --}}
                        {!!Form::open(['id' => $videoComment->id, 'action' =>
                        'VideoCommentLikesController@store',
                        'method' => 'POST'])!!}
                        {{ Form::hidden('comment-id', $videoComment->id) }}
                        {{ Form::hidden('video-id', $videoComment->video_id) }}
                        {!!Form::close()!!}
                        <a href='#' onclick='event.preventDefault();
													 document.getElementById("{{ $videoComment->id }}").submit();'>
                            {!!$heart!!}
                        </a>
                        <!-- Default dropup button -->
                        <div class="dropup float-right">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <svg class="bi bi-three-dots-vertical" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0" style="border-radius: 0;">
                                @php
                                    $videoCommentD = 'comment-delete-form' . $videoComment->id;
                                @endphp
                                @if($videoComment->username == $user->username)
                                    {!!Form::open(['id' => $videoCommentD, 'action' =>
                                    ['VideoCommentsController@destroy',
                                    $videoComment->id], 'method' => 'POST'])!!}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {!!Form::close()!!}
                                    <a href='#' class="dropdown-item" onclick='event.preventDefault();
													 document.getElementById("{{ $videoCommentD }}").submit();'>
                                        <h6 class="p-1">Delete comment</h6>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <!-- End of Comment Section -->
    </div>

    {{-- Up next area --}}
    <div class="col-sm-3">
        <div class='p-2 border-bottom'>
            <h5>Up Next</h5>
        </div>
        @if(count($videos) > 0)
            @foreach($videos as $video)
                @php
                    /* Check if song is bought */
                    $boughtVideoQuery = $boughtVideos->where('username',
                    $user->username)->where('video_id', $video->id)->count();
                @endphp
                @if($boughtVideoQuery == 1
                    && $video->id != $show->id)
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
                                <small class="m-0">{{ $video->bought_videos->count() }} Downloads</small>
                            </h6>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        {{-- End Up next up area --}}
        <br>
        <br>

        {{-- Song suggestion area --}}
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
                        $cart = "
                        <button class='btn btn-light mb-1' style='min-width: 40px; height: 33px;'>
                            <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path fill-rule='evenodd'
                                    d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                            </svg>
                        </button>";
                        $bbtn = "<button class='btn mysonar-btn green-btn float-right'>buy</button>";
                    @endphp
                @else
                    @if($boughtVideoQuery > 0)
                        @php
                            $cart = "";
                            $bbtn = "
                            <button class='btn btn-sm btn-light float-right'>Owned
                                <svg class='bi bi-check' width='1em' height='1em' viewBox='0 0 16 16'
                                    fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd'
                                        d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
                                </svg>
                            </button>";
                        @endphp
                    @else
                        @php
                            $cart = "
                            <button class='mysonar-btn mb-1' style='min-width: 40px;'>
                                <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16'
                                    fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd'
                                        d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                                </svg>
                            </button>";
                            $cForm = "";
                            $bbtn = "<button class='btn mysonar-btn green-btn float-right'>buy</button>";
                            $dForm = "";
                        @endphp
                    @endif
                @endif
                @if($boughtVideoQuery == 0
                    && $video->username != $user->username
                    && $video->id != $show->id)
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
                                <small class="m-0">{{ $video->bought_videos->count() }} Downloads</small>
                            </h6>
                            {{-- Add song to cart --}}
                            {!!Form::open(['id' => 'video-cart-form' . $video->id, 'action' =>
                            'CartVideosController@store',
                            'method' => 'POST'])!!}
                            {{ Form::hidden('cart-video-song', $video->id) }}
                            {{ Form::hidden('to', '/video-charts/' . $show->id) }}
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
