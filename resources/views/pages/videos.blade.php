@extends('layouts/app')

@section('content')
@include('inc/topnav')

<br>
<br>
<br class="hidden">

<!-- ***** Call to Action Area Start ***** -->
<div class="sonar-call-to-action-area section-padding-0-100">
    <div class="backEnd-content">
        <h2>Studio</h2>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <center>
                {{-- <a href="/audios" class="btn sonar-btn">go to audios</a>
                <br>
                <br> --}}
                <a href="/videos/create" class="btn sonar-btn">upload video</a>
                <br>
                <br>
                <a href="/video-albums/create" class="btn sonar-btn">create video album</a>
            </center>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2">
            <h1>Stats</h1>
            <table class='table'>
                <tr>
                    <th class="border-top-0">
                        <h5>Videos</h5>
                    </th>
                    <th class="border-top-0">
                        <h5>{{ $videos->count() }}</h5>
                    </th>
                </tr>
                <tr>
                    <th>
                        <h5>Video Albums</h5>
                    </th>
                    <th>
                        <h5>{{ $videoAlbums->count() }}</h5>
                    </th>
                </tr>
                <tr>
                    <td class="border-right-0">
                        <h5>Downloads</h5>
                    </td>
                    <td>
                        <h5>{{ $downloads }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Unpaid</h6>
                    </td>
                    <td>
                        @php
                            $payoutSum = $payouts / 10;
                            $thisWeekDown = $downloads - $payoutSum;
                            $totalRevenue = $payoutSum * 10;
                            $thisWeekRev = $totalRevenue - $payoutSum * 10;
                        @endphp
                        <h6>{{ $thisWeekDown }}</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Revenue</h5>
                    </td>
                    <td>
                        <h5 style='color: green;'>KES {{ $totalRevenue }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Unpaid</h6>
                    </td>
                    <td>
                        <h6 style='color: green;'>KES {{ $thisWeekRev }}</h6>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-sm-9">
            <h1>Singles</h1>
            <br>
            <table class="table table-responsive table-hover">
                <tr>
                    <th>
                        <h5>Thumbnail</h5>
                    </th>
                    <th>
                        <h5>Video Name</h5>
                    </th>
                    <th>
                        <h5>Artist</h5>
                    </th>
                    <th>
                        <h5>ft</h5>
                    </th>
                    <th>
                        <h5>Album</h5>
                    </th>
                    <th>
                        <h5>Genre</h5>
                    </th>
                    <th>
                        <h5>Description</h5>
                    </th>
                    <th>
                        <h5>Downloads</h5>
                    </th>
                    <th>
                        <h5 style="color: green;">Revenue</h5>
                    </th>
                    <th>
                        <h5>Likes</h5>
                    </th>
                    <th>
                        <h5>Released</h5>
                    </th>
                    <th>
                        <h5>Uploaded</h5>
                    </th>
                    <th>
                        <h5></h5>
                    </th>
                </tr>
                @if(count($videosSingles) > 0)
                    @foreach($videosSingles as $videosSingle)
                        <tr>
                            <td><a href='/charts/{{ $videosSingle->id }}'>
                                    <img src="{{ $videosSingle->thumbnail }}" width="160em" height="90em"
                                        alt="thumbnail">
                                </a>
                            </td>
                            <td>{{ $videosSingle->name }}</td>
                            <td>{{ $videosSingle->username }}</td>
                            <td>{{ $videosSingle->ft }}</td>
                            <td>{{ $videosSingle->album }}</td>
                            <td>{{ $videosSingle->genre }}</td>
                            <td>{{ $videosSingle->description }}</td>
                            <td>{{ $videosSingle->bought_videos->count() }}</td>
                            <td style='color: green;'>KES {{ $videosSingle->bought_videos->count() * 10 }}</td>
                            <td>{{ $videosSingle->video_likes->count() }}</td>
                            <td>{{ date("d F Y", strtotime($videosSingle->released)) }}
                            </td>
                            <td>{{ date("d F Y", strtotime($videosSingle->created_at)) }}
                            </td>
                            <td><a href='/videos/{{ $videosSingle->id }}/edit'>
                                    <button class='mysonar-btn'>edit</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
            <br>
            <br>
            @if(count($videoAlbums))
                @foreach($videoAlbums as $videoAlbum)
                    <div class="media">
                        <div class="media-left">
                            <a href="/video-albums/{{ $videoAlbum->id }}/edit">
                                <img src="/storage/{{ $videoAlbum->cover }}" width="auto" height="100"
                                    alt="album cover">
                            </a>
                        </div>
                        <div class="media-body p-2">
                            <small>Video Album</small>
                            <h1>{{ $videoAlbum->name }}</h1>
                            <h6>{{ date("F Y", strtotime($videoAlbum->released)) }}</h6>
                        </div>
                    </div>
                    <br>
                    <table class="table table-hover">
                        <tr>
                            <th>
                                <h5>Thumbnail</h5>
                            </th>
                            <th>
                                <h5>Video Name</h5>
                            </th>
                            <th>
                                <h5>Artist</h5>
                            </th>
                            <th>
                                <h5>ft</h5>
                            </th>
                            <th>
                                <h5>Album</h5>
                            </th>
                            <th>
                                <h5>Genre</h5>
                            </th>
                            <th>
                                <h5>Description</h5>
                            </th>
                            <th>
                                <h5>Downloads</h5>
                            </th>
                            <th>
                                <h5 style="color: green;">Revenue</h5>
                            </th>
                            <th>
                                <h5>Likes</h5>
                            </th>
                            <th>
                                <h5>Released</h5>
                            </th>
                            <th>
                                <h5>Uploaded</h5>
                            </th>
                            <th>
                                <h5></h5>
                            </th>
                        </tr>
                        <tr>
                            @php
                                $albumItems = $videos->where('album', $videoAlbum->id);
                            @endphp
                            @if(count($albumItems) > 0)
                                @foreach($albumItems as $albumItem)
                                    <td><a href='/charts/{{ $albumItem->id }}'>
                                            <img src="{{ $albumItem->thumbnail }}" width="160em" height="90em"
                                                alt="thumbnail">
                                        </a>
                                    </td>
                                    <td>{{ $albumItem->name }}</td>
                                    <td>{{ $albumItem->username }}</td>
                                    <td>{{ $albumItem->ft }}</td>
                                    <td>{{ $albumItem->album }}</td>
                                    <td>{{ $albumItem->genre }}</td>
                                    <td>{{ $albumItem->description }}</td>
                                    <td>{{ $albumItem->bought_videos->count() }}</td>
                                    <td style='color: green;'>KES {{ $albumItem->bought_videos->count() * 10 }}
                                    </td>
                                    <td>{{ $albumItem->video_likes->count() }}</td>
                                    <td>{{ date("d F Y", strtotime($albumItem->released)) }}
                                    </td>
                                    <td>{{ date("d F Y", strtotime($albumItem->created_at)) }}
                                    </td>
                                    <td><a href='/videos/{{ $albumItem->id }}/edit'>
                                            <button class='mysonar-btn'>edit</button>
                                        </a>
                                    </td>
                        </tr>
                @endforeach
            @endif
            </tr>
            </table>
            @endforeach
            @endif
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>

@include('inc/bottomnav')
@endsection
