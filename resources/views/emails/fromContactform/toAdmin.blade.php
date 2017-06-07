<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@component('mail::message')

Письмо с контактной формы сайта {{ Config::get('settings.domain') }}.
<br>
Тема: {{ $letter->subject }}
<br>
Отправлено: {{ \App\Helpers\Date::format($letter->created_at) }}
<br>
Имя отправителя: {{ $letter->name }}
<br>
Email отправителя: {{ $letter->email }}
<br>
Текст письма: {{ $letter->message }}

@endcomponent