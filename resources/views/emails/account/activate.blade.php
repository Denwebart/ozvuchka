<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@component('mail::message')

Для Вас был создан аккаунт на сайте {{ Config::get('settings.domain') }}.

Для активации аккаунта перейдите по ссылке

@component('mail::button', ['url' => $activationLink])

Активировать аккаунт

@endcomponent

@endcomponent