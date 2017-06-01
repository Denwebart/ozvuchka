<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$route = isset($route) ? $route : \Route::current()->getName();
?>

<div class="card-box p-0 m-b-20">
    @if(count($letters))
        <ul class="message-list m-b-0">
            @foreach($letters as $letter)
                <li class="@if(!$letter->read_at) unread @endif @if($letter->deleted_at && !Request::is('admin/letters/trash*') && $route !== 'admin.letters.trash') deleted @endif">
                    <a href="{{ route('admin.letters.show', ['id' => $letter->id]) }}">
                        <div class="col col-1">
                            <div class="checkbox-wrapper-mail">
                                <input type="checkbox" id="chk-{{ $letter->id }}">
                                <label for="chk-{{ $letter->id }}" class="toggle"></label>
                            </div>
                            <p class="title">{{ $letter->name }}</p>
                            @if(!$letter->is_important)
                                <button type="button" class="button-make-important star-toggle fa fa-star-o" data-item-id="{{ $letter->id }}" data-is-important="{{ $letter->is_important }}" data-toggle="tooltip" title="Отметить как важное"></button>
                            @else
                                <button type="button" class="button-make-important star-toggle fa fa-star text-warning" data-item-id="{{ $letter->id }}" data-is-important="{{ $letter->is_important }}" data-toggle="tooltip" title="Снять метку &#34;Важное&#34;"></button>
                            @endif
                        </div>
                        <div class="col col-2">
                            <div class="subject">
                                @if($letter->deleted_at && !Request::is('admin/letters/trash*') && $route !== 'admin.letters.trash')
                                    <del>{{ $letter->subject }}</del>
                                @else
                                    {{ $letter->subject }}
                                @endif
                            </div>
                            <div class="date">
                                {{ \App\Helpers\Date::format($letter->created_at, true, true) }}
                            </div>
                            <div class="buttons">
                                @if($letter->deleted_at && (Request::is('admin/letters/trash*') || $route == 'admin.letters.trash'))
                                    <button type="button" class="button-undelete fa fa-reply" data-item-id="{{ $letter->id }}" data-toggle="tooltip" title="Переместить во входящие"></button>
                                @endif
                                <button type="button" class="button-delete fa @if(!$letter->deleted_at) fa-trash-o @else fa-trash @endif" data-item-id="{{ $letter->id }}" data-is-deleted="{{ $letter->deleted_at ? 1 : 0 }}" data-toggle="tooltip" title="@if(!$letter->deleted_at) Удалить в корзину @else Удалить из корзины @endif"></button>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <div class="background-icon text-center">
            <p>Писем нет</p>
            <i class="fa fa-envelope"></i>
        </div>
    @endif
</div> <!-- panel body -->

@if(count($letters))
    <div class="row">
        <div class="col-xs-7">
            Показано с 1 по {{ $letters->count() }}. Всего писем: {{ $letters->total() }}.
        </div>
        <div class="col-xs-5">
            <div class="pull-right">
                {{ $letters->links() }}
            </div>
        </div>
    </div>
@endif