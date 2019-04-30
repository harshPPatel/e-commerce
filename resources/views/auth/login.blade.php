@extends('layouts.auth')

@section('title')
    {{ config('app.name') }} | Login
@endsection

@section('content')

    <div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 pb--50">
                    <h1 class="text-center">Login</h1>
                </div>
            </div>
            <!-- Start Login Register Content -->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="htc__login__register__wrap">
                        <!-- Start Single Content -->
                        <div id="login" class="single__tabs__panel tab-pane fade in active">
                            <form class="login" method="post" action="{{ route('login') }}">
                                @csrf

                                <input
                                    type="email"
                                    id="email"
                                    class="@error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    autofocus
                                    placeholder="User Email*">

                                {{-- Handling Email Errors --}}
                                @error('email')
                                <p class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror

                                <input
                                    id="password"
                                    type="password"
                                    class="@error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Password*">

                                @error('password')
                                <p class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
                                <div class="tabs__checkbox">
                                    <div>
                                        <input
                                                type="checkbox"
                                                name="remember"
                                                id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <span class="forget">
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </span>
                                    @endif
                                </div>
                                <div class="htc__login__btn mt--30">
                                    <button type="submit">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                            <div class="htc__social__connect">
                                <h2>Or Login With</h2>
                                <ul class="htc__soaial__list">
                                    <li><a class="bg--twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>

                                    <li><a class="bg--instagram" href="#"><i class="zmdi zmdi-instagram"></i></a></li>

                                    <li><a class="bg--facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>

                                    <li><a class="bg--googleplus" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>
            <!-- End Login Register Content -->
        </div>
    </div>
@endsection

