<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(isset($user))
    <div class="modal-body">
        @if($user->id)
            {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'users-form']) !!}
        @else
            {!! Form::model($user, ['route' => ['admin.users.store'], 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'users-form']) !!}
        @endif
        {!! Form::hidden('deleteImage', 0, ['id' => 'deleteImage']) !!}
        <div class="row">
            <div class="col-md-8">
                @if($user->created_at)
                    <p>
                        <label for="created_at" class="control-label m-r-5">Дата регистрации пользователя:</label>
                        <span class="date" id="created_at">
                        {{ \App\Helpers\Date::format($user->created_at, true) }}
                        @if(\App\Helpers\Date::format($user->created_at, true) != \App\Helpers\Date::getRelative($user->created_at, true))
                            ({{ \App\Helpers\Date::getRelative($user->created_at, true) }})
                        @endif
                    </span>
                    </p>
                @endif
                @if($user->deleted_at)
                    <p>
                        <label for="deleted_at" class="control-label m-r-5">Дата удаления:</label>
                        <span class="date" id="deleted_at">
                        {{ \App\Helpers\Date::format($user->deleted_at, true) }}
                        @if(\App\Helpers\Date::format($user->deleted_at, true) != \App\Helpers\Date::getRelative($user->deleted_at, true))
                            ({{ \App\Helpers\Date::getRelative($user->deleted_at, true) }})
                        @endif
                    </span>
                    </p>
                @endif
            </div>
            <div class="col-md-4">
                {{--<div class="switchery-demo @if(!$user->created_at && !$user->published_at) m-b-10 @endif">--}}
                    {{--{!! Form::hidden('is_published', 0) !!}--}}
                    {{--{!! Form::checkbox('is_published', 1, $user->id ? $user->is_published : 1, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}--}}
                    {{--{!! Form::label('is_published', 'Опубликовано', ['class' => 'control-label m-l-5']) !!}--}}
                {{--</div>--}}
                {{--<span class="help-block error is_published_error text-danger font-12" style="display: none">--}}
                    {{--<i class="fa fa-times-circle"></i>--}}
                    {{--<strong></strong>--}}
                {{--</span>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                {!! Form::file('avatar', ['id' => 'avatar', 'class' => 'dropify', 'data-default-file' => $user->id ? $user->getAvatarUrl(false) : false, 'data-max-file-size' => '3M', 'data-min-width' => '370', 'data-min-height' => '225']) !!}
                <span class="help-block error avatar_error text-danger font-12" style="display: none">
                    <i class="fa fa-times-circle"></i>
                    <strong></strong>
                </span>
            </div>
            <div class="col-sm-8">
                <div class="no-margin m-b-10">
                    {!! Form::label('login', 'Логин:', ['class' => 'control-label m-b-10']) !!}
                    {!! Form::text('login', $user->login, ['id' => 'login', 'class' => 'form-control maxlength', 'maxlength' => 20]) !!}
                    <span class="help-block error login_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                        <strong></strong>
                    </span>
                </div>
                <div class="no-margin m-b-10">
                    {!! Form::label('email', 'Email:', ['class' => 'control-label m-b-10']) !!}
                    {!! Form::text('email', $user->email, ['id' => 'email', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                    <span class="help-block error email_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                        <strong></strong>
                    </span>
                </div>
                @if(Auth::user()->hasAdminPermission() && !Auth::user()->is($user))
                    <div class="no-margin m-b-10">
                        <label for="role" class="control-label">Роль:</label>
                        <div class="clearfix"></div>

                        <div class="radio radio-inline radio-success">
                            <input type="radio" id="role-{{ \App\Models\User::ROLE_ADMIN }}" value="{{ \App\Models\User::ROLE_ADMIN }}" name="role" @if($user->role == \App\Models\User::ROLE_ADMIN) checked @endif>
                            <label for="role-{{ \App\Models\User::ROLE_ADMIN }}">{{ \App\Models\User::$roles[\App\Models\User::ROLE_ADMIN] }}</label>
                        </div>
                        <div class="radio radio-inline radio-info">
                            <input type="radio" id="role-{{ \App\Models\User::ROLE_MODERATOR }}" value="{{ \App\Models\User::ROLE_MODERATOR }}" name="role" @if($user->role == \App\Models\User::ROLE_MODERATOR) checked @endif>
                            <label for="role-{{ \App\Models\User::ROLE_MODERATOR }}">{{ \App\Models\User::$roles[\App\Models\User::ROLE_MODERATOR] }}</label>
                        </div>
                        <div class="radio radio-inline radio-muted">
                            <input type="radio" id="role-{{ \App\Models\User::ROLE_NONE }}" value="{{ \App\Models\User::ROLE_NONE }}" name="role" @if($user->role == \App\Models\User::ROLE_NONE) checked @endif>
                            <label for="role-{{ \App\Models\User::ROLE_NONE }}">{{ \App\Models\User::$roles[\App\Models\User::ROLE_NONE] }}</label>
                        </div>

                        <span class="help-block error role_error text-danger font-12" style="display: none">
                            <i class="fa fa-times-circle"></i>
                            <strong></strong>
                        </span>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="no-margin m-b-10">
                    {!! Form::label('firstname', 'Имя:', ['class' => 'control-label m-b-10']) !!}
                    {!! Form::text('firstname', $user->firstname, ['id' => 'firstname', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                    <span class="help-block error firstname_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                    <strong></strong>
                </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="no-margin m-b-10">
                    {!! Form::label('lastname', 'Фамилия:', ['class' => 'control-label m-b-10']) !!}
                    {!! Form::text('lastname', $user->lastname, ['id' => 'lastname', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                    <span class="help-block error lastname_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                    <strong></strong>
                </span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="no-margin m-b-20">
                    {!! Form::label('description', 'Описание:', ['class' => 'control-label m-b-10']) !!}
                    {!! Form::textarea('description', $user->description, ['id' => 'description', 'class' => 'form-control maxlength', 'maxlength' => 255, 'rows' => 2]) !!}
                    <span class="help-block error description_error text-danger font-12" style="display: none">
                        <i class="fa fa-times-circle"></i>
                    <strong></strong>
                </span>
                </div>
            </div>
        </div>
        @if($user->id)
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-default waves-effect" data-toggle="collapse" data-target="#change-password">Изменить пароль</button>
                </div>
                <div id="change-password" class="collapse">
                    <div class="col-md-12">
                        @if($user->id)
                            <span class="help-block">
                                <small>Не заполняйте эти поля, если не собираетесь менять пароль.</small>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="no-margin m-b-10">
                            {!! Form::label('password', 'Пароль:', ['class' => 'control-label m-b-10']) !!}
                            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                            <span class="help-block error password_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="no-margin m-b-10">
                            {!! Form::label('password_confirmation', 'Повтор пароля:', ['class' => 'control-label m-b-10']) !!}
                            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                            <span class="help-block error password_confirmation_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {!! Form::close() !!}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Закрыть</button>
        <button type="button" class="button-save btn btn-custom waves-effect waves-light">
            @if($user->id)
                Сохранить изменения
            @else
                Добавить
            @endif
        </button>
    </div>
@endif