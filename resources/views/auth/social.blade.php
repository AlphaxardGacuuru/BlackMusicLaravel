@extends('layouts/app')
@section('content')
@include('inc/topnav')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <br>
        <br>
        <br>
        <br>
        <center>
            <h2>Create your account {{ $name }}</h2>
            {!! Form::open(['action' => 'UserController@store', 'method' => 'POST', 'class' => 'contact-form']) !!}
            {{ Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required']) }}
            <br>
            {{ Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Phone', 'required']) }}
            <br>
            {{ Form::hidden('name', $name) }}
            {{ Form::hidden('email', $email) }}
            {{ Form::submit('create', ['class' => 'sonar-btn']) }}
            {!! Form::close() !!}
        </center>
    </div>
    <div class="col-sm-4"></div>
</div>
@include('inc/bottomnav')
@endsection
