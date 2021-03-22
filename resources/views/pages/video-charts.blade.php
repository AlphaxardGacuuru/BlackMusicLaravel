@php
    use App\BoughtVideos;
    use App\VideoLikes;
    use App\Videos;
    use App\Follow;
    use App\CartVideos;
    use App\User;
@endphp
@extends('layouts/app')
@section('content')
@include('inc/topnav')
<br>
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
@php
    /* Function for adding into an array */
    function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
    }
    $newlyClass = $trendClass = $topDownClass = $topLovedClass = $orderBy = $targetVideo = $minDate = $artistsWHERE =
    "";
@endphp
@if($chart == 'newlyReleased')
    @php
        $videoChart = Videos::get();
        $minDate = 30;
        $ANDvSong_id = '';
        $newlyClass = "class='active-scrollmenu'";
    @endphp
@elseif($chart == 'trending')
    @php
        $videoChart = BoughtVideos::get();
        $minDate = 7;
        $ANDvSong_id = 'AND id =';
        $trendClass = "class='active-scrollmenu'";
    @endphp
@elseif($chart == 'topDownloaded')
    @php
        $videoChart = BoughtVideos::get();
        $minDate = 1000;
        $ANDvSong_id = 'AND id =';
        $topDownClass = "class='active-scrollmenu'";
    @endphp
@elseif($chart == 'topLoved')
    @php
        $videoChart = VideoLikes::get();
        $minDate = 1000;
        $ANDvSong_id = 'AND id =';
        $topLovedClass = "class='active-scrollmenu'";
    @endphp
@endif
@php
    $AllClass = $AfroClass = $BengaClass = $BluesClass = $BoombaClass = $CountryClass = $CulturalClass = $EDMClass =
    $GengeClass = $GospelClass = $HiphopClass = $JazzClass = $MoKClass = $PopClass = $RandBClass = $RockClass =
    $SesubeClass = $TaarabClass = "";
@endphp
@if($vGenre == 'All')
    @php
        $ANDvGenre = "";
        $AllClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Afro')
    @php
        $ANDvGenre = 'AND genre = "Afro"';
        $AfroClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Benga')
    @php
        $ANDvGenre = 'AND genre = "Benga"';
        $BengaClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Blues')
    @php
        $ANDvGenre = 'AND genre = "Blues"';
        $BluesClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Boomba')
    @php
        $ANDvGenre = 'AND genre = "Boomba"';
        $BoombaClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Country')
    @php
        $ANDvGenre = 'AND genre = "Country"';
        $CountryClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Cultural')
    @php
        $ANDvGenre = 'AND genre = "Cultural"';
        $CulturalClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'EDM')
    @php
        $ANDvGenre = 'AND genre = "EDM"';
        $EDMClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Genge')
    @php
        $ANDvGenre = 'AND genre = "Genge"';
        $GengeClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Gospel')
    @php
        $ANDvGenre = 'AND genre = "Gospel"';
        $GospelClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Hiphop')
    @php
        $ANDvGenre = 'AND genre = "Hiphop"';
        $HiphopClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Jazz')
    @php
        $ANDvGenre = 'AND genre = "Jazz"';
        $JazzClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'MoK')
    @php
        $ANDvGenre = 'AND genre = "Music of Kenya"';
        $MoKClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Pop')
    @php
        $ANDvGenre = 'AND genre = "Pop"';
        $PopClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'RandB')
    @php
        $ANDvGenre = 'AND genre = "R&B"';
        $RandBClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Rock')
    @php
        $ANDvGenre = 'AND genre = "Rock"';
        $RockClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Sesube')
    @php
        $ANDvGenre = 'AND genre = "Sesube"';
        $SesubeClass = "class='active-scrollmenu'";
    @endphp
@elseif($vGenre == 'Taarab')
    @php
        $ANDvGenre = 'AND genre = "Taarab"';
        $TaarabClass = "class='active-scrollmenu'";
    @endphp
@endif

{{-- Carousel --}}
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        @php
            $carousel = Videos::orderby('id', 'DESC')->limit(3)->get();
            $i = 1;
        @endphp
        @foreach($carousel as $item)
            <div class="carousel-item @if($i == 1){{ 'active' }}@endif" style="overflow: hidden;">
                <img class="d-block w-100" src="{{ $item->thumbnail }}" alt="Thumbnail">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color: gold;">{{ $item->name }}</h5>
                    <p style="color: gold;">{{ $item->username }}</p>
                </div>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    </div>
    {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a> --}}
</div>
{{-- Carousel End --}}

<!-- Scroll menu -->
{{-- <div id="chartsMenu" class="hidden-scroll" style="margin: 10px 0 0 0;">
    <span>
        <a href="#">
            <h3 class="active-scrollmenu">Videos</h3>
        </a>
    </span>
    <span>
        <a href="/audio-charts/newlyReleased/All">
            <h3>Audios</h3>
        </a>
    </span>
</div> --}}
<div id="chartsMenu" class="hidden-scroll" style="margin: 10px 0 0 0;">
    <span>
        <a href="/video-charts/newlyReleased/All">
            <h5 {!!$newlyClass!!}>Newly Released</h5>
        </a>
    </span>
    <span>
        <a href="/video-charts/trending/All">
            <h5 {!!$trendClass!!}>Trending</h5>
        </a>
    </span>
    <span>
        <a href="/video-charts/topDownloaded/All">
            <h5 {!!$topDownClass!!}>Top Downloaded</h5>
        </a>
    </span>
    <span>
        <a href="/video-charts/topLoved/All">
            <h5 {!!$topLovedClass!!}>Top Loved</h5>
        </a>
    </span>
</div>

<div id="video-chartsMenu" class="hidden-scroll" style="margin: 0 0 0 0;">
    <span>
        <a href="/video-charts/{!!$chart!!}/All">
            <h6 {!!$AllClass!!}>All</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Afro">
            <h6 {!!$AfroClass!!}>Afro</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Benga">
            <h6 {!!$BengaClass!!}>Benga</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Blues">
            <h6 {!!$BluesClass!!}>Blues</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Boomba">
            <h6 {!!$BoombaClass!!}>Boomba</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Country">
            <h6 {!!$CountryClass!!}>Country</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Cultural">
            <h6 {!!$CulturalClass!!}>Cultural</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/EDM">
            <h6 {!!$EDMClass!!}>EDM</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Genge">
            <h6 {!!$GengeClass!!}>Genge</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Gospel">
            <h6 {!!$GospelClass!!}>Gospel</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Hiphop">
            <h6 {!!$HiphopClass!!}>Hiphop</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Jazz">
            <h6 {!!$JazzClass!!}>Jazz</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/MoK">
            <h6 {!!$MoKClass!!}>Music of Kenya</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Pop">
            <h6 {!!$PopClass!!}>Pop</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/RandB">
            <h6 {!!$RandBClass!!}>R&B</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Rock">
            <h6 {!!$RockClass!!}>Rock</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Sesube">
            <h6 {!!$SesubeClass!!}>Sesube</h6>
        </a>
    </span>
    <span>
        <a href="/video-charts/{!!$chart!!}/Taarab">
            <h6 {!!$TaarabClass!!}>Taarab</h6>
        </a>
    </span>
</div>
<!-- End of scroll menu -->

<!-- Chart Area -->
<div class="row hidden">
    <div class="col-sm-12">

        <!-- ****** Artists Area Start ****** -->
        <h5>Artists</h5>
        <div class="hidden-scroll">
            @php
                /*Get relevant songs*/
                /*Add to trend_week*/
                /* Gets date in array form */
                $trendWeek = getdate(strtotime("next Friday"));
                $dVar = $trendWeek[0];
                $vidsArray = array();
            @endphp
            @foreach($videoChart as $videoChart)
                @if($chart == 'newlyReleased')
                    @php
                        $tDate = 0;
                        $targetVideo = $videoChart->id;
                    @endphp
                @else
                    @php
                        $tDate = $dVar - strtotime($videoChart->created_at);
                        $targetVideo = $videoChart->video_id;
                    @endphp
                @endif
                @php
                    $tDate = $tDate/86400;
                @endphp
                @if($tDate < $minDate)
                    @if(array_key_exists($targetVideo, $vidsArray))
                        @php
                            $vidsArray[$targetVideo] +=1;
                        @endphp
                    @else
                        @php
                            $vidsArray = array_push_assoc($vidsArray, $targetVideo, 1);
                        @endphp
                    @endif
                @endif
            @endforeach
            @php
                arsort($vidsArray);
                /* echo print_r($vidsArray) . '<br>' ;
                echo count($vidsArray) . "<br>"; */

                /*Create relevant array for artist*/
                $artistsArray = array();
            @endphp
            @foreach($vidsArray as $targetVideo => $downloads)
                @php
                    $fetchArtist = Videos::where('id', $targetVideo)->first();
                @endphp
                @if(array_key_exists($fetchArtist->username, $artistsArray))
                    @php
                        $artistsArray[$fetchArtist->username] += $downloads;
                    @endphp
                @else
                    @php
                        $artistsArray = array_push_assoc($artistsArray, $fetchArtist->username,
                        $downloads);
                    @endphp
                @endif
            @endforeach
            @php
                arsort($artistsArray);
                /* echo print_r($artistsArray) . '<br>';
                echo count($artistsArray) . "<br>"; */
            @endphp

            {{-- Get winner --}}
            @if($chart == 'trending')
                @php
                    $referralList = array();
                @endphp
                @foreach($artistsArray as $trendingArtist => $userDownloads)
                    @php
                        $referrals = Referrals::where('username', $trendingArtist)->get();
                        $referralCount = $referrals->count();
                    @endphp
                    @if($referralCount >= 2)
                        @for($i=0; $i < $referralCount; $i++)
                            @php
                                $rSongFetch = Videos::where('username', $referrals->referrer);
                            @endphp
                            @if($rSongFetch)
                                @if(array_key_exists($trendingArtist, $artistsArray))
                                    @php
                                        $referralList[$trendingArtist] +=1;
                                    @endphp
                                @else
                                    @php
                                        $referralList = array_push_assoc($referralList, $trendingArtist, 1);
                                    @endphp
                                @endif
                            @endif
                        @endfor
                    @endif
                @endforeach
                @php
                    arsort($referralList);
                    /* echo print_r($referralList) . '<br>' ; echo count($referralList)
                    . "<br>" ; echo key($referralList) . "<br>" ; */
                    $winner = key($referralList);
                @endphp
            @endif

            {{-- Trending --}}
            {{-- Echo Artists according to most songs sold in one week --}}
            @foreach($artistsArray as $targetArtist => $userDownloads)
                @if($chart == 'trending')
                    @if($targetArtist == $winner)
                        @php
                            $position = "<h6 style='background-color: green;'>
                                <small style='color: white;'>Top</small>
                            </h6>
                            ";
                        @endphp
                    @elseif(array_key_exists($targetArtist, $referralList))
                        @php
                            $position = "<h6 style='background-color: green;'>
                                <small style='color: white;'>$userDownloads Downloads</small>
                            </h6>";
                        @endphp
                    @else
                        @php
                            $position = "<h6 style='background-color: orange;'>
                                <small style='color: white;'>$userDownloads Downloads</small>
                            </h6>";
                        @endphp
                    @endif
                @else
                    @php
                        $position = "";
                    @endphp
                @endif
                {{-- Trending End --}}
                {{-- Fetch Artists --}}
                @php
                    $musician = User::where('username', $targetArtist)->first();
                    $followQuery = Follow::where('followed', $targetArtist)->where('username',
                    $user->username)->count();
                    $targetVideosQuery = BoughtVideos::where('username',
                    $user->username)->where('bought_video_artist', $targetArtist)->count();
                    if ($followQuery == 0) {
                    if ($targetVideosQuery > 0 || $user->username == '@blackmusic') {
                    $fBtn = Form::submit('follow', ['class' => 'mysonar-btn float-right']);
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
                {{-- Fetch Artists End --}}
                {{-- Echo Artists --}}
                <span class="pt-0 pl-0 pr-0 pb-2" style='border-radius: 10px'>
                    <center>
                        <div class="card avatar-thumbnail" style="border-radius: 50%;">
                            <a href='/home/{{ $musician->username }}'>
                                <img src="/storage/{{ $musician->pp }}" width='150px' height='150px' alt=''>
                            </a>
                        </div>
                        <h6 style='width: 100px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            {{ $musician->name }}
                        </h6>
                        {{-- <h6 style='width: 100px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            <small>{{ $musician->username }}</small>
                        </h6> --}}
                        {{ $position }}
                        {{-- {{ $fBtn }} --}}
                    </center>
                </span>

                <!-- The actual snackbar for following message -->
                <div id='checker'>You must have bought atleast 1 song by that Musician</div>
                {{-- Echo Artists End --}}
            @endforeach
        </div>
        <!-- ****** Artists Area End ****** -->
        <br>

        <!-- ****** Songs Area ****** -->
        <h5>Songs</h5>
        <div>
            @if($chart == 'newlyReleased')
                @php
                    $vidsArray = array(0 => 0);
                @endphp
            @endif
            @foreach($vidsArray as $targetVideo => $downloads)
                @php
                    $fade = "black";
                @endphp
                @if($chart == 'newlyReleased')
                    @php
                        $targetVideo = "";
                        $dThisWeek = "";
                    @endphp
                @else
                    @php
                        $dThisWeek = "<span style='font-size: 1rem; color: green;'>&#x2022;</span> <span
                            style='color: green;'>$downloads</span>";
                        $fadeFetch = $videoChart->where('video_id', $targetVideo)->first();
                        $fadeDate = time() - strtotime($fadeFetch->created_at);
                        $fadeDate = $fadeDate/86400;
                    @endphp
                    @if($fadeDate > 7)
                        @php
                            $fade = "lightgrey";
                        @endphp
                    @endif
                @endif
                {{-- Get songs --}}
                @php
                    $squer = Videos::whereRaw('username != "" ' . $ANDvGenre . ' ' . $ANDvSong_id . ' ' .
                    $targetVideo)->orderBy('id', 'desc')->get();
                @endphp
                @foreach($squer as $video)
                    @php
                        /* Check if song is in cart */
                        $cartVideoQuery = CartVideos::where('video_id',
                        $video->id)->where('username', $user->username)->count();
                        /* Check if song is bought */
                        $targetVideoQuery = BoughtVideos::where('username',
                        $user->username)->where('video_id', $video->id)->count();
                        if ($cartVideoQuery > 0) {
                        $cart = Form::button("
                        <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                        </svg>",
                        ['class' => 'btn btn-light mb-1', 'style' => 'min-width: 90px; height: 33px;']);
                        $bbtn = Form::submit("buy", ['class' => 'btn mysonar-btn green-btn']);
                        } else {
                        if ($targetVideoQuery > 0) {
                        $cart = "";
                        $bbtn = Form::button("Owned
                        <svg class='bi bi-check' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
                        </svg>",
                        ['class' => 'btn btn-sm btn-light']);
                        } else {
                        $cart = Form::button("
                        <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd'
                                d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                        </svg>",
                        ['type' => 'submit', 'class' => 'mysonar-btn mb-1']);
                        $bbtn = Form::submit("buy", ['class' => 'btn mysonar-btn green-btn']);
                        }
                        }
                    @endphp
                    @if($targetVideoQuery == 0)
                        <span class="card m-1 pb-2"
                            style='border-radius: 10px; display: inline-block; text-align: center;'>
                            <div class="thumbnail" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <a href='/video-charts/{{ $video->id }}'>
                                    <img src='{{ $video->thumbnail }}' width="160em" height="90em">
                                </a>
                            </div>
                            <h6
                                style='padding: 10px 5px 0 5px; margin: 0px; width: 150px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                {{ $video->name }}</h6>
                            <h6 style='margin: 0px 5px 0px 5px; padding: 0px 5px 0px 5px;'>
                                <small>{{ $video->username }} {{ $video->ft }}</small>
                            </h6>
                            <h6>
                                <small style='margin: 0px 5px 0px 5px; padding: 0px 5px 0px 5px;'>
                                    {{ $video->bought_videos->count() }} Downloads
                                </small>
                            </h6>
                            {{-- Add song to cart --}}
                            {!!Form::open(['action' => 'CartVideosController@store',
                            'method'
                            => 'POST'])!!}
                            {{ Form::hidden('cart-video-song', $video->id) }}
                            {{ Form::hidden('to', 'video-charts/' . $chart . '/' . $vGenre) }}
                            {{ $cart }}
                            {!!Form::close()!!}
                            {{-- Buy song --}}
                            {!!Form::open(['action' => 'CartVideosController@store',
                            'method'
                            => 'POST'])!!}
                            {{ Form::hidden('cart-video-song', $video->id) }}
                            {{ Form::hidden('to', 'cart') }}
                            {{ $bbtn }}
                            {!!Form::close()!!}
                        </span>
                    @endif
                @endforeach
            @endforeach
        </div>
        <!-- ****** Songs Area End ****** -->
        <!-- End of Chart Area -->
    </div>
</div>

{{-- For mobile --}}
<div class="row anti-hidden">
    <div class="col-sm-12">
        <div class="p-2">
            <h5>Artists</h5>
            <div class="hidden-scroll border-bottom">
                @foreach($artistsArray as $targetArtist => $userDownloads)
                    @if($chart == 'trending')
                        @if($targetArtist == $winner)
                            @php
                                $position = "<h6 style='background-color: green;'>
                                    <small style='color: white;'>Top</small>
                                </h6>
                                ";
                            @endphp
                        @elseif(array_key_exists($targetArtist, $referralList))
                            @php
                                $position = "<h6 style='background-color: green;'>
                                    <small style='color: white;'>$userDownloads Downloads</small>
                                </h6>";
                            @endphp
                        @else
                            @php
                                $position = "<h6 style='background-color: orange;'>
                                    <small style='color: white;'>$userDownloads Downloads</small>
                                </h6>";
                            @endphp
                        @endif
                    @else
                        @php
                            $position = "";
                        @endphp
                    @endif
                    @php
                        $musician = User::where('username', $targetArtist)->first();
                        $followQuery = Follow::where('followed', $targetArtist)->where('username',
                        $user->username)->count();
                        $targetVideosQuery = BoughtVideos::where('username',
                        $user->username)->where('bought_video_artist', $targetArtist)->count();
                        if ($followQuery == 0) {
                        if ($targetVideosQuery > 0 || $user->username == '@blackmusic') {
                        $fBtn =
                        Form::submit('follow', ['class' => 'mysonar-btn']);
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
                    <span class="pt-0 pl-0 pr-0 pb-2" style='border-radius: 10px'>
                        <center>
                            <div class="card avatar-thumbnail" style="border-radius: 50%;">
                                <a href='/home/{{ $musician->username }}'>
                                    <img src="/storage/{{ $musician->pp }}" width='150px' height='150px' alt=''>
                                </a>
                            </div>
                            <h6 class="p-0 m-0"
                                style='width: 100px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                                {{ $musician->name }}
                            </h6>
                            {{-- <h6 class="p-0 mt-0 mr-0 ml-0" style='width: 100px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            <small>{{ $musician->username }}</small>
                            </h6> --}}
                            {{ $position }}
                            {{-- {{ $fBtn }} --}}
                        </center>
                    </span>

                    <!-- The actual snackbar for following message -->
                    <div id='checker'>You must have bought atleast 1 song by that Musician</div>
                @endforeach
                <br>
                <br>
            </div>
            {{-- Artists Area end --}}

            {{-- Songs area start --}}
            @if($chart == 'newlyReleased')
                @php
                    $vidsArray = array(0 => 0);
                @endphp
            @endif
            @foreach($vidsArray as $targetVideo => $downloads)
                @php
                    $fade = "black";
                @endphp
                @if($chart == 'newlyReleased')
                    @php
                        $targetVideo = "";
                        $dThisWeek = "";
                    @endphp
                @else
                    @php
                        $dThisWeek = "<span style='font-size: 1rem; color: green;'>&#x2022;</span> <span
                            style='color: green;'>$downloads</span>";
                        $fadeFetch = $videoChart->where('video_id', $targetVideo)->first();
                        $fadeDate = time() - strtotime($fadeFetch->created_at);
                        $fadeDate = $fadeDate/86400;
                    @endphp
                    @if($fadeDate > 7)
                        @php
                            $fade = "lightgrey";
                        @endphp
                    @endif
                @endif
                {{-- Get songs --}}
                @php
                    $squer = Videos::whereRaw('username != "" ' . $ANDvGenre . ' ' . $ANDvSong_id . ' ' .
                    $targetVideo)->orderBy('id',
                    'desc')->get();
                @endphp
                @foreach($squer as $video)
                    @php
                        /* Check if song is in cart */
                        $cartVideoQuery = CartVideos::where('video_id',
                        $video->id)->where('username', $user->username)->count();
                        /* Check if song is bought */
                        $targetVideoQuery = BoughtVideos::where('username',
                        $user->username)->where('video_id', $video->id)->count();
                    @endphp
                    @if($cartVideoQuery > 0)
                        @php
                            $cart = "<button class='btn btn-light mb-1' style='min-width: 40px; height: 33px;'>
                                <svg class='bi bi-cart3' width='1em' height='1em' viewBox='0 0 16 16'
                                    fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd'
                                        d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z' />
                                </svg>";
                                $bbtn = "<button class='btn mysonar-btn green-btn float-right'>buy</button>";
                        @endphp
                    @else
                        @if($targetVideoQuery > 0)
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
                    @if($targetVideoQuery == 0)
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
                                {{ Form::hidden('to', 'video-charts/' . $chart . '/' . $vGenre) }}
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
                                    {!!$cart!!}
                                </a>
                                <a href='#' style="color: #000;" onclick='event.preventDefault();
													 document.getElementById("{{ 'video-buy-form' . $video->id }}").submit();'>
                                    {!!$bbtn!!}
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@include('inc/bottomnav')
@endsection
