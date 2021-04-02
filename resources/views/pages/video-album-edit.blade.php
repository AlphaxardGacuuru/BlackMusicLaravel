@extends('layouts/app')

@section('content')
@include('inc/topnav')

<!-- Preloader Start -->
<div id="preloader">
    <div class="preload-content">
        <div id="sonar-load"></div>
    </div>
</div>
<!-- Preloader End -->

<br>
<br>
<br>

<!-- ***** Call to Action Area Start ***** -->
<div class="sonar-call-to-action-area section-padding-0-100">
    <div class="backEnd-content">
        <h2>Studio</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form text-center call-to-action-content wow fadeInUp" data-wow-delay="0.5s">
                    <h2>Edit {{ $videoAlbum->name }}</h2>
                    <br>
                    <div class="form-group">
                        {!! Form::open(['action' => ['VideoAlbumsController@update', $videoAlbum->id],
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data']) !!}
                        {{ Form::hidden('_method', 'PUT') }}
                        <br>
                        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => $videoAlbum->name]) }}
                        <br>
                        <br>
                        <label for="">Released</label>
                        {{ Form::date('released', '', ['class' => 'form-control', 'placeholder' => 'Released']) }}
                        <br>
                        <br>
                        <label>Upload Album Cover</label>
                        {{ Form::file('cover', ['class' => 'form-control', 'accept' => 'image/*']) }}
                        <br>
                        <br>
                        {{ Form::submit('save changes', ['class' => 'sonar-btn']) }}
                        {!! Form::close() !!}
                        <br>
                        <a href="/videos" class="btn sonar-btn">studio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc/bottomnav')
@endsection
