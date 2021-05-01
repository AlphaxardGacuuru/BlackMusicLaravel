@extends('layouts/app')

@section('content')
@include('inc/topnav')
<div class="row">
    <div class="col-sm-4"></div>
    <div style="text-align: center;" class="col-sm-4">
        {{-- <br>
        <br>
        <br class="hidden">
        <br class="hidden">
        <h1>INVITES</h1>
        <br>
        <h5>Invite your friends to Black Music and <i style="color: green;">earn!</i>.</h5>
        <h5>It's easy!</h5>
        <br>
        <a href='/referrals' class="btn sonar-btn">go to invites</a>
        <br> --}}

        <!-- Profile Pic Form -->
        <br id="pp">
        <hr>
        <br>
        <div class="contact-form form-group">
            <h1>UPDATE PASSWORD</h1>
            <br>
            {!! Form::open(['action' => ['HomeController@update', Auth::user()->id], 'method' => 'POST', 'enctype'
            => 'multipart/form-data']) !!}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'New Password']) }}
            <br>
            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
            <br>
            @if(Auth::user()->account_type == 'musician')
                <h1>UPDATE WITHDRAWAL AMOUNT</h1>
                {{ Form::text('withdrawal', null, ['class' => 'form-control', 'placeholder' => 'KES ' . Auth::user()->withdrawal]) }}
                <br>
            @else
                <h1>BECOME A MUSICIAN</h1>
                <br>
                <h6>{{ Form::radio('acc-type', 'musician') }}
                    I'm a musician
                </h6>
                <br>
                <br>
                <br>
            @endif
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::hidden('to', 'settings') }}
            {{ Form::reset('reset', ['class' => 'sonar-btn']) }}
            <br class="anti-hidden">
            <br class="anti-hidden">
            {{ Form::submit('save changes', ['class' => 'sonar-btn']) }}
            {!! Form::close() !!}
        </div>
        <!-- Profile Pic Form End -->

        <!-- Deactivate Area -->
        <!-- Modal for Deactivating Account -->
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b style="color: red;">WARNING</b> Account Deactivation!</h4>
                        <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to <b>DEACTIVATE</b> your <b>Black Music Account</b>.</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                        <form action="deactivate.php" method="POST">
                            <button type="submit" style="float: left;" class="btn btn-sm btn-danger"
                                name="Deactivate">Deactivate</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <hr>
        <br>

        <!-- single accordian area -->
        {{-- <div class="panel single-accordion">
            <h6>
                <a role="button" class="collapsed" aria-expanded="true" aria-controls="collapseTwo"
                    data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">Deactivate account
                    <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                    <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                </a>
            </h6>
            <div id="collapseTwo" class="accordion-content collapse">
                <br>
                <h1>DEACTIVATE ACCOUNT</h1>
                <br>
                <br>
                <button type="button" class="sonar-btn" data-toggle="modal"
                    data-target="#deleteModal">Deactivate</button>
            </div>
        </div> --}}
        <div class="col-sm-4"></div>
    </div>
    <!-- End of Deactivate Area -->
</div>
<div class="col-sm-4"></div>
@include('inc/bottomnav')
@endsection
