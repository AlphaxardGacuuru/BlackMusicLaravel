@extends('layouts/app')

@section('content')
@include('inc/topnav')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <center>
            <br>
            <br>
            <br>
            <h3>Oops!</h3>
            <h4>You can't access this page when you're offline</h4>
            <br>
            <a href="/posts" class="btn sonar-btn">go to home page</a>
        </center>
    </div>
    <div class="col-sm-4"></div>
</div>
@include('inc/bottomnav')
@endsection
