@extends('layouts/app')

@section('content')
@include('inc/topnav')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        {{-- Profile Pic Form --}}
        <br id="pp">
        <hr>
        <br>
        <div class="contact-form form-group">
            <center>
                <h1>EDIT PROFILE</h1>
                <br>
                {{-- <div class="avatar-container">
                    <img class="avatar hover-img" src="/storage/{{ Auth::user()->pp }}" alt="Avatar">
                <div class="overlay">
                    <button class="edit-button mysonar-btn">EDIT</button>
                </div>
        </div> --}}
        {!! Form::open(['action' => ['HomeController@update', Auth::user()->id], 'method' => 'POST',
        'enctype' => 'multipart/form-data']) !!}
        <br>
        {{ Form::label('pp', 'Profile Pic', ['class' => 'float-left']) }}
        {{ Form::file('profile-pic', ['class' => 'form-control']) }}
        <br>
        {{ Form::label('name', 'Name', ['class' => 'float-left']) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => Auth::user()->name]) }}
        <br>
        {{ Form::label('email', 'Email', ['class' => 'float-left']) }}
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => Auth::user()->email]) }}
        <br>
        {{ Form::label('bio', 'Bio', ['class' => 'float-left']) }}
        {{ Form::text('bio', null, ['class' => 'form-control', 'placeholder' => Auth::user()->bio]) }}
        {{-- <br>
            {{ Form::label('loc', 'Location', ['class' => 'float-left']) }}
        {{ Form::text('loc', Auth::user()->loc, ['class' => 'form-control']) }}
        --}}
        <br>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::hidden('to', 'edit') }}
        {{ Form::reset('reset', ['class' => 'sonar-btn']) }}
        <br class="anti-hidden">
        <br class="anti-hidden">
        {{ Form::submit('save changes', ['class' => 'sonar-btn']) }}
        {!! Form::close() !!}
        </center>
    </div>
</div>
<div class="col-sm-4"></div>
</div>
@include('inc/bottomnav')
@endsection
