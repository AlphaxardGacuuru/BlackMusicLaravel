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
                    <h2>Create Audio Album</h2>
                    <br>
                    <div class="form-group">
                        {!! Form::open(['action' => 'AudioAlbumsController@store', 'method' => 'POST', 'enctype' =>
                        'multipart/form-data']) !!}
                        <br>
                        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
                        <br>
                        <br>
                        <label for="">Released</label>
                        {{ Form::date('released', '', ['class' => 'form-control', 'placeholder' => 'Released', 'required']) }}
                        <br>
                        <br>
                        <label>Upload Album Cover</label>
                        {{ Form::file('cover', ['class' => 'form-control', 'accept' => 'image/*', 'required']) }}
                        <br>
                        <br>
                        {{ Form::submit('create album', ['class' => 'sonar-btn']) }}
                        {!! Form::close() !!}
                        <br>
                        <a href="/audios" class="btn sonar-btn">go to audios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc/bottomnav')
@endsection
