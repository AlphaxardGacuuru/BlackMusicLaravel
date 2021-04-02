@extends('layouts/app')

@section('content')
@include('inc/topnav')
<br>
<br>
<br class="hidden">
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-3">
        <div class='p-2 border-bottom'>
            <h5>Your Cart</h5>
        </div>
        @if(count($cartVideos) > 0)
            @foreach($cartVideos as $cartVideo)
                <div class='media p-2 border-bottom'>
                    <div class='media-left thumbnail'>
                        <a href='#'>
                            <img src='{{ $cartVideo->videos->thumbnail }}' width="160em" height="90em">
                        </a>
                    </div>
                    <div class='media-body ml-2'>
                        <h6 class="m-0"
                            style='width: 160px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            {{ $cartVideo->videos->name }}</h6>
                        <h6 style='width: 140px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            <small>{{ $cartVideo->videos->username }}</small>
                        </h6>
                        <h6 style='color: green;'>KES 20</h6>
                        {!!Form::open(['action' => ['CartVideosController@destroy', $cartVideo->cart_video_id],
                        'method' =>
                        'POST'])!!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{Form::button('
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
								</svg>',
								['type' => 'submit', 'class' => 'mysonar-btn float-right'])}}
                        {!!Form::close()!!}
                    </div>
                </div>
                </>
            @endforeach
        @endif
    </div>
    <div class="col-sm-4">
        <div class='p-2 border-bottom'>
            <h5>Purchase History</h5>
        </div>
        @if(count($boughtVideos) > 0)
            @foreach($boughtVideos as $boughtVideo)
                <div class='media p-2 border-bottom'>
                    <div class='media-left thumbnail'>
                        <a href='#'>
                            <img src='{{ $boughtVideo->videos->thumbnail }}' width="160em" height="90em">
                        </a>
                    </div>
                    <div class='media-body ml-2'>
                        <h6 class="m-0"
                            style='width: 160px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            {{ $boughtVideo->bought_video_name }}</h6>
                        <h6 style='width: 140px; white-space: nowrap; overflow: hidden; text-overflow: clip;'>
                            <small>{{ $boughtVideo->bought_video_artist }}</small>
                        </h6>
                    </div>
                </div>
                </>
            @endforeach
        @endif
    </div>
    <div class="col-sm-3">
        @if($permission >= 1)
            <div class='p-2 border-bottom'>
                <h5 style='color: green;'>Payment received!</h5>
            </div>
        @else
            <div class='p-2 border-bottom'>
                <h5 style='color: red;'>Payment not received or is not enough!</h5>
            </div>
        @endif
        <div class="p-2 border-bottom">
            <h5>Account Balance</h5>
            <h5 style='color: green;'>KES {{ $balance }}</h5>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>
@include('inc/bottomnav')
@endsection
