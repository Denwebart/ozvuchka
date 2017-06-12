@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="text-center account-logo-box">
        <h2 class="text-uppercase">
            <a href="{{ url('/') }}" class="logo text-success">
                <img src="{{ asset('images/logo_dark.svg') }}" alt="{{ Config::get('settings.domain') }}">
            </a>
        </h2>
        <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
    </div>
    <div class="account-content">
        <div class="text-center m-b-20">
            <h5>Сброс пароля</h5>
            <p class="text-muted m-b-0">Пожалуйста, заполните поля ниже для того, чтобы сбросить пароль</p>
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
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ $email or old('email') }}" required="" placeholder="Введите email">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="password">Новый пароль</label>
                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Введите новый пароль">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="password">Подтверждение пароля</label>
                    <input class="form-control" type="password" required="" id="password_confirmation" name="password_confirmation" placeholder="Введите пароль ещё раз">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn btn-md btn-block btn-inverse waves-effect waves-light" type="submit">Сбросить пароль</button>
                </div>
            </div>

        </form>

        <div class="clearfix"></div>

        <div class="row m-t-10">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Вернуться ко <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Входу</b></a></p>
            </div>
        </div>

    </div>

</div>
@endsection