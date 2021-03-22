@extends('layouts/app')

@section('content')
@include('inc/topnav')
<br>
<br class="hidden">
<br class="hidden">
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="p-2 border-bottom">
            <br>
            <h5>Library</h5>
        </div>
        @if(count($boughtVideos) > 0)
            @foreach($boughtVideos as $boughtVideo)
                <div class="media p-2 border-bottom">
                    <div class="media-left thumbnail">
                        <a href='/video-charts/{{ $boughtVideo->video_id }}'>
                            <img src='{{ $boughtVideo->videos->thumbnail }}' width="160em" height="90em">
                        </a>
                    </div>
                    <div class="media-body ml-2">
                        <h6 class="m-0"
                            style='width: 150px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            {{ $boughtVideo->videos->name }}</h6>
                        <h6 class="m-0">
                            <small>{{ $boughtVideo->videos->username }}
                                {{ $boughtVideo->videos->ft }}</small>
                        </h6>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="col-sm-4"></div>
</div>
@include('inc/bottomnav')
@endsection
