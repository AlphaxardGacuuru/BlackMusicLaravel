@extends('layouts/app')

@section('content')
@include('inc/topnav')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <br>
        <h1>Oops! You can't access this page when you're offline</h1>
        <br>
        <button class="sonar-btn">go to home page</button>
    </div>
    <div class="col-sm-4"></div>
</div>
@include('bottomnav')
@endsection
