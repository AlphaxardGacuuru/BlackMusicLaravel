@extends('layouts/app')
@section('content')
@include('inc/topnav')
<br>
<br>
<br>
<br class="hidden">
{{-- <div class="row">
    <div class="col-sm-12">

        <!-- Search Form -->
        <div class="card">
            <div class="contact-form text-center call-to-action-content wow fadeInUp" data-wow-delay="0.5s">
                <form action="analytics.php" method="GET">
                    <input style='margin: 0; width: 100%; padding: 10px;' type='text' name='search' class="form-control"
                        placeholder='Search'>
                </form>
            </div>
        </div>
        <table class="table table-responsive table-hover" style="background-color: lightblue;">
            <tr>
                <td>UserID</td>
                <td>Name</td>
                <td>Username</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Gender</td>
                <td>Acc Type</td>
                <td>Bio</td>
                <td>Following</td>
                <td>Fans</td>
                <td>Deco</td>
                <td>DOB</td>
                <td>Location</td>
                <td>Audios Bought</td>
                <td>Videos Bought</td>
                <td>Date Joined</td>
                <td>Time Joined</td>
            </tr>
            <tr>
                <td>$user_id</td>
                <td>$name</td>
                <td>$username</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$gender</td>
                <td>$acc_type</td>
                <td>$bio</td>
                <td>$following</td>
                <td>$fans</td>
                <td>$deco</td>
                <td>$dob</td>
                <td>$location</td>
                <td>$asongs_bought</td>
                <td>$vsongs_bought</td>
                <td>$date_joined</td>
                <td>$time_joined</td>
            </tr>
        </table>
    </div>
</div> --}}
<!-- Search Form End -->

<div class="row">
    <div class="col-sm-2">
        <!-- Number of Users Start-->
        <div class="card">
            <table class='table'>
                <tr>
                    <td>
                        <h4>Users</h4>
                    </td>
                    <td>
                        {{ $users->count() }}
                    </td>
                </tr>
                <!-- Number of Users End -->

                <!-- Number of Musicians Start-->
                <tr>
                    <td>
                        <h4>Musicians</h4>
                    </td>
                    <td>
                        {{ $users->where('acc_type', 'musician')->count() - 1 }}
                    </td>
                </tr>
                <!-- Number of Musicians End -->

                <!-- Number of Songs Start -->
                <tr>
                    <td>
                        <h4>Songs</h4>
                    </td>
                    <td>
                        {{ $videos->count() }}
                    </td>
                </tr>
                <!-- Number of Songs End -->

                <!-- Number of Songs Bought Start -->
                <tr>
                    <td>
                        <h4>Songs Bought</h4>
                    </td>
                    <td>
                        {{ $boughtVideos->count() }}
                    </td>
                </tr>
                <!-- Number of Songs Bought End -->

                <!-- Revenue Start -->
                <tr>
                    <td>
                        <h4>Revenue</h4>
                    </td>
                    <td style="color: green;">
                        KES {{ $boughtVideos->count() * 20 }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>this week</h6>
                    </td>
                    <td>
                        @php
                            $sum = $boughtVideos->count() * 20;
                            $payoutSum = $payouts->sum('amount') * 2;
                            $payoutTotal = $sum-$payoutSum;
                        @endphp
                        <h6>KES {{ $payoutTotal }}</h6>
                    </td>
                </tr>
                <!-- Revenue End -->

                <!-- Profit Start -->
                <tr>
                    <td>
                        <h4>Profit</h4>
                    </td>
                    <td style="color: green;">
                        KES {{ $boughtVideos->count() * 10 }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>this week</h6>
                    </td>
                    <td style="color: green;">
                        @php
                            $sum = $boughtVideos->count() * 10;
                            $payoutSum = $payouts->sum('amount');
                            $payoutTotal = $sum-$payoutSum;
                        @endphp
                        <h6>KES {{ $payoutTotal }}</h6>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Profit End -->
        <br>
        <!-- <a href="admin_actions.php"><button class="sonar-btn">change</button></a> -->
    </div>
    <div class="col-sm-9">
        <!-- <div class="card"> -->
        <table class="table table-responsive table-hover">
            <tr>
                <td>User ID</td>
                <td>Name</td>
                <td>Username</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Gender</td>
                <td>Acc Type</td>
                <td>Bio</td>
                <td>Deco</td>
                <td>DOB</td>
                <td>Location</td>
                <td>Audios Bought</td>
                <td>Videos Bought</td>
                <td>Date Joined</td>
            </tr>
            @php
                $users = $users->limit(10)->get();
            @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->acc_type }}</td>
                    <td>{{ $user->bio }}</td>
                    <td>{{ $user->deco }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>{{ $user->location }}</td>
                    <td>{{ $user->asongs_bought }}</td>
                    <td>{{ $user->vsongs_bought }}</td>
                    <td>{{ $user->date_joined }}</td>
                </tr>
            @endforeach
        </table>
        <!-- </div> -->
    </div>
    <div class="col-sm-1"></div>
</div>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-9">
        <h1 style="text-align: center;">Song Payouts</h1>
        <br>
        <table class="table table-responsive table-hover">
            <tr>
                <th>Name</th>
                <th>Artist</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Minimum</th>
                <th>Amount</th>
            </tr>
            @foreach($users as $user)
                @php
                    $sum = $boughtVideos->where('bought_video_artist', $user->username)->count() * 10;
                    $payoutSum = $payouts->where('username', $user->username)->sum('amount');
                    $payoutTotal = $sum-$payoutSum;
                    $phonenumber = substr_replace($user->phone,'0',0,-9);
                    if(preg_match( '/^(\d{4})(\d{3})(\d{3})$/', $phonenumber, $matches)) {
                    $phone = $matches[1] . ' ' .$matches[2] . ' ' . $matches[3];
                    }
                @endphp
                @if($payoutTotal != 0)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->withdrawal }}</td>
                        <td>
                            {{-- Add song to cart --}}
                            {!!Form::open(['action' => 'PayoutsController@store', 'method' => 'POST'])!!}
                            {{ Form::hidden('artist', $user->username) }}
                            {{ Form::hidden('amount', $payoutTotal) }}
                            {{ Form::submit('kes ' . $payoutTotal, ['class' => 'btn mysonar-btn green-btn']) }}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    <div class="col-sm-1"></div>
</div>
@include('inc/bottomnav')
@endsection
