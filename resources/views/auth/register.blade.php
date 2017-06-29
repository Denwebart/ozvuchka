@extends('layouts.auth')

@section('content')
<div class="account-box">
    <div class="account-logo-box">
        <h2 class="text-uppercase text-center">
            <a href="{{ url('/') }}" class="logo text-success">
                <img src="{{ asset('images/logo_dark.svg') }}" alt="{{ Config::get('settings.domain') }}">
            </a>
        </h2>
        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Регистрация</h5>
        <p class="m-b-0">Нового пользователя</p>
    </div>
    <div class="account-content">

        @if(session('status'))

            <div class="m-b-10 text-center">
                <svg version="1.1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 98 98"
                     style="enable-background:new 0 0 98 98;height: 140px;" xml:space="preserve">
                    <style type="text/css">
                        .st0{fill:#FFFFFF;}
                        .st1{fill:#4489e4;}
                        .st2{fill:#FFFFFF;stroke:#4489e4;stroke-width:2;stroke-miterlimit:10;}
                        .st3{fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;}
                    </style>
                    <g i:extraneous="self">
                        <circle id="XMLID_50_" class="st0" cx="49" cy="49" r="49"/>
                        <g id="XMLID_4_">
                            <path id="XMLID_49_" class="st1" d="M77.3,42.7V77c0,0.6-0.4,1-1,1H21.7c-0.5,0-1-0.5-1-1V42.7c0-0.3,0.1-0.6,0.4-0.8l27.3-21.7
                                                                c0.3-0.3,0.8-0.3,1.2,0l27.3,21.7C77.1,42.1,77.3,42.4,77.3,42.7z"/>
                            <path id="XMLID_48_" class="st2" d="M66.5,69.5h-35c-1.1,0-2-0.9-2-2V26.8c0-1.1,0.9-2,2-2h35c1.1,0,2,0.9,2,2v40.7
                                                                C68.5,68.6,67.6,69.5,66.5,69.5z"/>
                            <path id="XMLID_47_" class="st1" d="M62.9,33.4H47.2c-0.5,0-0.9-0.4-0.9-0.9v-0.2c0-0.5,0.4-0.9,0.9-0.9h15.7
                                                                c0.5,0,0.9,0.4,0.9,0.9v0.2C63.8,33,63.4,33.4,62.9,33.4z"/>
                            <path id="XMLID_46_" class="st1" d="M62.9,40.3H47.2c-0.5,0-0.9-0.4-0.9-0.9v-0.2c0-0.5,0.4-0.9,0.9-0.9h15.7
                                                                c0.5,0,0.9,0.4,0.9,0.9v0.2C63.8,39.9,63.4,40.3,62.9,40.3z"/>
                            <path id="XMLID_45_" class="st1" d="M62.9,47.2H47.2c-0.5,0-0.9-0.4-0.9-0.9v-0.2c0-0.5,0.4-0.9,0.9-0.9h15.7
                                                                c0.5,0,0.9,0.4,0.9,0.9v0.2C63.8,46.8,63.4,47.2,62.9,47.2z"/>
                            <path id="XMLID_44_" class="st1" d="M62.9,54.1H47.2c-0.5,0-0.9-0.4-0.9-0.9v-0.2c0-0.5,0.4-0.9,0.9-0.9h15.7
                                                                c0.5,0,0.9,0.4,0.9,0.9v0.2C63.8,53.7,63.4,54.1,62.9,54.1z"/>
                            <path id="XMLID_43_" class="st2" d="M41.6,40.1h-5.8c-0.6,0-1-0.4-1-1v-6.7c0-0.6,0.4-1,1-1h5.8c0.6,0,1,0.4,1,1v6.7
                                                                C42.6,39.7,42.2,40.1,41.6,40.1z"/>
                            <path id="XMLID_42_" class="st2" d="M41.6,54.2h-5.8c-0.6,0-1-0.4-1-1v-6.7c0-0.6,0.4-1,1-1h5.8c0.6,0,1,0.4,1,1v6.7
                                                                C42.6,53.8,42.2,54.2,41.6,54.2z"/>
                            <path id="XMLID_41_" class="st1" d="M23.4,46.2l25,17.8c0.3,0.2,0.7,0.2,1.1,0l26.8-19.8l-3.3,30.9H27.7L23.4,46.2z"/>
                            <path id="XMLID_40_" class="st3" d="M74.9,45.2L49.5,63.5c-0.3,0.2-0.7,0.2-1.1,0L23.2,45.2"/>
                        </g>
                    </g>
                </svg>

                <p class="text-muted font-13 m-t-10">
                    {{ session('status') }}
                </p>

            </div>

        @else

            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">

                {{ csrf_field() }}

                <div class="form-group m-b-20{{ $errors->has('login') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <label for="login">Логин</label>
                        <input class="form-control" type="text" id="login" name="login" value="{{ old('login') }}" required="" placeholder="Введите логин">

                        @if ($errors->has('login'))
                            <span class="help-block">
                                <strong>{{ $errors->first('login') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group m-b-20{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <label for="email">Email</label>
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
                        <label for="password">Пароль</label>
                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Введите пароль">

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
                        <input class="form-control" type="password" required="" id="password_confirmation" name="password_confirmation" placeholder="Повторите пароль">

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
                                Я соглашаюсь с <a href="#">правилами сайта</a>
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
                        <button class="btn btn-md btn-block btn-inverse waves-effect waves-light" type="submit">Зарегистрироваться</button>
                    </div>
                </div>

            </form>

            <div class="row m-t-20">
                <div class="col-sm-12 text-center">
                    <p class="text-muted">Уже есть аккаунт?  <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Войти</b></a></p>
                </div>
            </div>

        @endif

    </div>
</div>
@endsection