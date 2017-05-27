<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Телефон</th>
        <th>Заметка</th>
        <th>Заказан</th>
        <th>Статус</th>
        <th>Обработан</th>
        <th class="hidden-sm">Действие</th>
    </tr>
    </thead>

    <tbody>
    @foreach($calls as $call)
        <tr class="item" data-page-id="{{ $call->id }}">
            <td>
                {{ $call->id }}
            </td>

            <td>
                <b>{{ $call->name }}</b>
            </td>

            <td>
                {{ \App\Helpers\Str::phoneFormat($call->phone) }}
            </td>

            <td width="30%">
                {{ $call->comment }}
            </td>

            <td>
                {{ \App\Helpers\Date::getRelative($call->created_at) }}
            </td>

            <td class="published-status">
                <span class="label @if(\App\Models\RequestedCall::STATUS_PHONED == $call->status) label-success @elseif(\App\Models\RequestedCall::STATUS_NOT_PHONED == $call->status) label-danger @else label-muted @endif">
                    {{ \App\Models\RequestedCall::$statuses[$call->status] }}
                </span>
            </td>

            <td>
                @if($call->user)
                    <img src="{{ $call->user->getAvatarUrl() }}" alt="{{ $call->user->login }}" title="{{ $call->user->login }}" data-toggle="tooltip" class="img-circle thumb-sm" />
                @endif
                {{ \App\Helpers\Date::getRelative($call->updated_at) }}
            </td>

            <td>
                <a href="#" class="button-edit table-action-btn" data-toggle="modal" data-target="#editing-call-modal" data-modal-id="editing-call-modal" data-item-id="{{ $call->id }}"><i class="mdi mdi-pencil" title="Редактировать" data-toggle="tooltip"></i></a>
                @if(Auth::user()->hasAdminPermission())
                    <a href="#" class="button-delete table-action-btn" data-item-id="{{ $call->id }}" title="Удалить" data-toggle="tooltip"><i class="mdi mdi-close"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>