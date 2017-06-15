<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@component('mail::message')

<h2>Заказан звонок через форму "Заказать звонок" на сайте {{ Config::get('settings.domain') }}.</h2>
<br>
<b>Заказан:</b>
<br>
{{ \App\Helpers\Date::format($call->created_at) }}
<br>
<br>
<b>Имя:</b>
<br>
{{ $call->name }}
<br>
<br>
<b>Телефон:</b>
<br>
{{ $call->phone }}

@endcomponent