@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="text-center account-logo-box">
        <h2 class="text-uppercase">
            <a href="{{ url('/') }}" class="text-success">
                <span><img src="{{ asset('backend/images/logo_dark.png') }}" alt="" height="30"></span>
            </a>
        </h2>
        <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
    </div>
    <div class="account-content">
        <div class="text-center m-b-20">
            <p class="text-muted m-b-0">Some text...</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">

            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group m-b-20{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="email">Email address</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ $email or old('email') }}" required="" placeholder="Enter your email">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="password">New password</label>
                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your new password">

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

            <div class="form-group text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Reset Password</button>
                </div>
            </div>

        </form>

        <div class="clearfix"></div>

        <div class="row m-t-40">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Back to <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
            </div>
        </div>

    </div>

</div>
@endsection