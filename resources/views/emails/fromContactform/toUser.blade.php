<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@component('mail::message')

<h2>Письмо, отправленное вами с контактной формы сайта {{ Config::get('settings.domain') }}.</h2>
<br>
<b>Тема:</b>
<br>
{{ $letter->subject }}
<br>
<br>
<b>Отправлено:</b>
<br>
{{ \App\Helpers\Date::format($letter->created_at) }}
<br>
<br>
<b>Имя отправителя:</b>
<br>
{{ $letter->name }}
<br>
<br>
<b>Email отправителя:</b>
<br>
{{ $letter->email }}
<br>
<br>
<b>Текст письма:</b> {{ $letter->message }}

@endcomponent