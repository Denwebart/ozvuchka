@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="account-logo-box">
        <h2 class="text-uppercase text-center">
            <a href="{{ url('/') }}" class="text-success">
                <span><img src="{{ asset('backend/images/logo_dark.png') }}" alt="" height="30"></span>
            </a>
        </h2>
        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
        <p class="m-b-0">Login to your Admin account</p>
    </div>
    <div class="account-content">

        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">

            {{ csrf_field() }}

            <div class="form-group m-b-20{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="email">Email address</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required="" placeholder="Enter your email">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <a href="{{ route('password.request') }}" class="text-muted pull-right"><small>Forgot your password?</small></a>
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" required="" placeholder="Enter your password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20">
                <div class="col-xs-12">

                    <div class="checkbox checkbox-success">
                        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            Remember me
                        </label>
                    </div>

                </div>
            </div>

            <div class="form-group text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                </div>
            </div>

        </form>

        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <button type="button" class="btn m-r-5 btn-facebook waves-effect waves-light">
                        <i class="fa fa-facebook"></i>
                    </button>
                    <button type="button" class="btn m-r-5 btn-googleplus waves-effect waves-light">
                        <i class="fa fa-google"></i>
                    </button>
                    <button type="button" class="btn m-r-5 btn-twitter waves-effect waves-light">
                        <i class="fa fa-twitter"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row m-t-50">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-dark m-l-5"><b>Sign Up</b></a></p>
            </div>
        </div>

    </div>
</div>
@endsection