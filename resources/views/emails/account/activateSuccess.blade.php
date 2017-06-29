<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@component('mail::message')

Вы успешно активировали аккаунт на сайте {{ Config::get('settings.domain') }}!

Для входа в административную панель используйте следующие учетные данные:

Адрес аккаунта: {{ route('login') }}
Логин: {{ $user->login }}

Если Вы вдруг забудете пароль, Вы можете восстановить его по этой ссылке:
<a href="{{ route('password.request') }}">{{ route('password.request') }}</a>.


@endcomponent