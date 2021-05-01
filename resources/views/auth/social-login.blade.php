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
            <a href="login/github" class="btn sonar-btn">github</a>
            <br>
            <br>
            <a href="login/google" class="btn sonar-btn">google</a>
            <br>
            <br>
            <a href="login/facebook" class="btn sonar-btn">facebook</a>
            <br>
            <br>
            <a href="login/twitter" class="btn sonar-btn">twitter</a>
        </center>
    </div>
    <div class="col-sm-4"></div>
</div>
@include('inc/bottomnav')
@endsection
