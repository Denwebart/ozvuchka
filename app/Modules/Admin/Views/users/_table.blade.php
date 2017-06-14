<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($users))
    @foreach($users as $user)
        <div class="user col-md-4" data-user-id="{{ $user->id }}">
            <div class="card-box">
                <div class="member-card-alt">
                    <a href="{{ route('admin.users.show', ['id' => $user->id]) }}" class="thumb-xl member-thumb pull-left">
                        <img src="{{ Auth::user()->getAvatarUrl() }}" class="img-thumbnail" alt="{{ $user->login }}">
                        @if(!$user->deleted_at)
                            <i class="mdi mdi-account-circle member-star text-success" title="Пользователь активен" data-toggle="tooltip"></i>
                        @else
                            <i class="mdi mdi-close-circle  member-star text-danger" title="Пользователь удален" data-toggle="tooltip"></i>
                        @endif
                    </a>

                    <div class="member-card-alt-info">
                        <h4 class="m-b-5 m-t-0">
                            <a href="{{ route('admin.users.show', ['id' => $user->id]) }}">
                                {{ $user->login }}
                            </a>
                        </h4>
                        @if($user->getFullName())
                            <p class="text-muted">{{ $user->getFullName() }}</p>
                        @endif
                        <p>
                        <span class="label @if($user->role == \App\Models\User::ROLE_ADMIN) label-success @elseif($user->role == \App\Models\User::ROLE_MODERATOR) label-info @else label-muted @endif m-b-10">
                            {{ \App\Models\User::$roles[$user->role] }}
                        </span>
                        </p>
                        <p class="text-dark">
                            <span>{{ $user->email }}</span>
                        </p>
                        <p class="text-muted font-13">
                            {{ $user->description }}
                        </p>

                        <!-- Edit -->
                        @if(Auth::user()->hasAdminPermission() || Auth::user()->is($user))
                            {{--<a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-default btn-sm m-t-15 waves-effect waves-light">--}}
                                {{--Редактировать--}}
                            {{--</a>--}}
                        @endif
                        <!-- Deleted/undeleted -->
                        @if(Auth::user()->hasAdminPermission() && !Auth::user()->is($user))
                            @if($user->deleted_at)
                                <button type="button" class="button-undelete btn btn-link text-success btn-sm m-t-15 waves-effect waves-light" data-item-id="{{ $user->id }}" data-item-title="{{ $user->login }}">Восстановить</button>
                            @else
                                <button type="button" class="button-delete btn btn-link text-danger btn-sm m-t-15 waves-effect waves-light" data-item-id="{{ $user->id }}" data-item-title="{{ $user->login }}" data-has-activities="{{ (count($user->pages) || count($user->comments) || count($user->requestedCalls)) ? 1 : 0 }}">Удалить</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    @endforeach
@else
    <div class="background-icon text-center">
        <p>Пользователей нет</p>
        <i class="fa fa-user-circle-o"></i>
    </div>
@endif