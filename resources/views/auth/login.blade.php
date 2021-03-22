@extends('layouts.app')

@section('content')
@include('inc/topnav')
<br>
<br>
<script>
    window.onload = function () {
        var src = document.getElementById("phone"),
            dst = document.getElementById("password");
        src.addEventListener('input', function () {
            dst.value = src.value;
        });
    };

</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body contact-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">
                                <p>{{ __('Phone') }}</p>
                            </label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" placeholder="" value="07" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                placeholder="username" value="@" required autocomplete="username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div> --}}

                {{-- <div class="form-group row">
                    <label for="email"
                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> --}}

            <div class="form-group row" style="display: none;">
                <label for="password" class="col-md-4 col-form-label text-md-right">
                    <p>
                        {{ __('Password is same as phone') }}</p>
                </label>

                <div class="col-md-6">
                    <input id="password" type="hidden" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row" style="display: none;">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                            checked="checked">

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="sonar-btn">
                        {{ __('Login') }}
                    </button>

                    @if(Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}"
                            style="display: none;">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@include('inc/bottomnav')
@endsection
