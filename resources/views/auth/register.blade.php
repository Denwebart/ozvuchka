@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="account-logo-box">
        <h2 class="text-uppercase text-center">
            <a href="{{ url('/') }}" class="text-success">
                <span><img src="{{ asset('backend/images/logo_dark.png') }}" alt="" height="30"></span>
            </a>
        </h2>
        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Register</h5>
        <p class="m-b-0">Get access to our admin panel</p>
    </div>
    <div class="account-content">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">

            {{ csrf_field() }}

            <div class="form-group m-b-20{{ $errors->has('login') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="login">Full Name</label>
                    <input class="form-control" type="text" id="login" name="login" value="{{ old('login') }}" required="" placeholder="Enter your login">

                    @if ($errors->has('login'))
                        <span class="help-block">
                            <strong>{{ $errors->first('login') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="email">Email address</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required="" placeholder="john@deo.com">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="password">Password confirmation</label>
                    <input class="form-control" type="password" required="" id="password_confirmation" name="password_confirmation" placeholder="Repeat your password">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('is_agree') ? ' has-error' : '' }}">
                <div class="col-xs-12">

                    <div class="checkbox checkbox-success">
                        <input id="is_agree" type="checkbox" name="is_agree" value="1">
                        <label for="is_agree">
                            I accept <a href="#">Terms and Conditions</a>
                        </label>
                        @if ($errors->has('is_agree'))
                            <span class="help-block error is_agree_error">
                                {{ $errors->first('is_agree') }}
                            </span>
                        @endif
                    </div>

                </div>
            </div>

            <div class="form-group text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign Up Free</button>
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
                <p class="text-muted">Already have an account?  <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
            </div>
        </div>

    </div>
</div>
@endsection