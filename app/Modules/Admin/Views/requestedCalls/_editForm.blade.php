<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(isset($call))
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label for="created_at" class="control-label m-r-5">№:</label>
                <span class="number" id="id"><b>{{ $call->id }}</b></span>
            </div>
            <div class="col-md-12">
                <label for="created_at" class="control-label m-r-5">Заказан:</label>
                <span class="date" id="created_at">
                    {{ \App\Helpers\Date::format($call->created_at, true) }}
                    @if(\App\Helpers\Date::format($call->created_at, true) != \App\Helpers\Date::getRelative($call->created_at, true))
                        ({{ \App\Helpers\Date::getRelative($call->created_at, true) }})
                    @endif
                </span>
            </div>
            <div class="col-sm-5">
                <h4 class="m-t-10 header-title">Имя:</h4>
                <div class="lead">{{ $call->name }}</div>
            </div>
            <div class="col-sm-7">
                <h4 class="m-t-10 header-title">Номер телефона:</h4>
                <div class="lead">{{ \App\Helpers\Str::phoneFormat($call->phone) }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::model($call, ['route' => ['admin.calls.update', $call->id], 'class' => 'form-horizontal', 'id' => 'editing-call-form']) !!}

                {!! Form::hidden('name', $call->name) !!}
                {!! Form::hidden('phone', $call->phone) !!}

                <div class="m-b-10">
                    <label for="status" class="control-label">Статус:</label>
                    <div class="clearfix"></div>
                    @foreach(\App\Models\RequestedCall::$statuses as $key => $value)
                        <div class="radio radio-inline @if(\App\Models\RequestedCall::STATUS_PHONED == $key) radio-success @elseif(\App\Models\RequestedCall::STATUS_NOT_PHONED == $key) radio-danger @else radio-muted @endif">
                            <input type="radio" id="status-{{ $key }}" value="{{ $key }}" name="status" @if($call->status == $key) checked @endif>
                            <label for="status-{{ $key }}">{{ $value }}</label>
                        </div>
                    @endforeach
                    <span class="help-block error status_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                        <strong></strong>
                    </span>
                </div>

                @if($call->updated_at)
                    <div class="m-b-10">
                        <label for="created_at" class="control-label m-r-5">Обработал:</label>
                        @if($call->user)
                            <a href="{{ route('admin.users.show', ['id' => $call->user->id]) }}" class="manager">
                                {{ $call->user->login }},
                            </a>
                        @endif
                        <span class="date" id="updated_at">
                            {{ \App\Helpers\Date::format($call->updated_at, true) }}
                        </span>
                    </div>
                @endif

                <div class="no-margin m-b-20">
                    <label for="comment" class="control-label m-b-10">Заметка:</label>
                    <textarea name="comment" class="form-control" id="comment" placeholder="Заметка">{{ $call->comment }}</textarea>
                    <span class="help-block error comment_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                        <strong></strong>
                    </span>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Закрыть</button>
        <button type="button" class="button-update btn btn-custom waves-effect waves-light">Сохранить изменения</button>
    </div>
@endif