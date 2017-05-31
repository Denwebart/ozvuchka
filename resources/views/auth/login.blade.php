@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="account-logo-box">
        <h2 class="text-uppercase text-center">
            <a href="{{ url('/') }}" class="text-success">
                <span><img src="{{ asset('backend/images/logo_dark.png') }}" alt="" height="30"></span>
            </a>
        </h2>
        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Вход</h5>
        <p class="m-b-0">В административную панель</p>
    </div>
    <div class="account-content">

        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">

            {{ csrf_field() }}

            <div class="form-group m-b-20{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <label for="email">Email или Логин</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Введите email-адрес или логин">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <a href="{{ route('password.request') }}" class="text-muted pull-right"><small>Забыли пароль?</small></a>
                    <label for="password">Пароль</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Введите пароль">

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
                            Запомнить меня
                        </label>
                    </div>

                </div>
            </div>

            <div class="form-group text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Войти</button>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection