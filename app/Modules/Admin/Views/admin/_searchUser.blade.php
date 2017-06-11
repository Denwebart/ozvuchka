<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="search-item">
    <div class="media">
        <div class="media-left">
            <a href="{{ route('admin.users.show', ['id' => $result->id]) }}" class="user-avatar">
                <img class="media-object img-circle" alt="{{ $result->login }}" src="{{ $result->getAvatarUrl() }}" style="width: 54px; height: 54px;">
                @if(!$result->deleted_at)
                    <i class="mdi mdi-account-circle user-status text-success" title="Пользователь активен" data-toggle="tooltip"></i>
                @else
                    <i class="mdi mdi-close-circle  user-status text-danger" title="Пользователь удален" data-toggle="tooltip"></i>
                @endif
            </a>
        </div>
        <div class="media-body">
            <h5 class="media-heading">
                <a href="{{ route('admin.users.show', ['id' => $result->id]) }}" class="text-dark">
                    {!! \App\Helpers\Str::getFragment($result->login, $searchQuery) !!}
                    @if($result->getFullName())
                        ({!! \App\Helpers\Str::getFragment($result->getFullName(), $searchQuery) !!})
                    @endif
                </a>
                <span class="label @if($result->role == \App\Models\User::ROLE_ADMIN) label-success @elseif($result->role == \App\Models\User::ROLE_MODERATOR) label-info @else label-muted @endif m-b-10">
                    {{ \App\Models\User::$roles[$result->role] }}
                </span>
            </h5>
            <p class="font-13">
                <b>Email:</b>
                <span>
                    <a href="{{ route('admin.users.show', ['id' => $result->id]) }}" class="text-muted">
                        {!! \App\Helpers\Str::getFragment($result->email, $searchQuery) !!}
                    </a>
                </span>
            </p>
            @if($result->description)
                <p class="m-b-0 font-13">
                    <b>Описание:</b>
                    <br/>
                    <span class="text-muted">
                        {!! \App\Helpers\Str::getFragment($result->description, $searchQuery) !!}
                    </span>
                </p>
            @endif
        </div>
    </div>
</div>