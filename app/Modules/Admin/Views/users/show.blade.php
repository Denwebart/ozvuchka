<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Пользователь {{ $user->login }}</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="#">Главная</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}">Пользователи</a>
                </li>
                <li class="active">
                    Пользователь {{ $user->login }}
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-sm-12">
        <div class="profile-bg-picture" style="background-image:url('/backend/images/bg-profile.jpg')">
            <span class="picture-bg-overlay"></span><!-- overlay -->
        </div>
        <!-- meta -->
        <div class="profile-user-box">
            <div class="row">
                <div class="col-sm-6">
                    <div class="user-avatar pull-left m-r-15">
                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ $user->login }}" class="thumb-lg img-circle">
                        @if(!$user->deleted_at)
                            <i class="mdi mdi-account-circle user-status text-success" title="Пользователь активен" data-toggle="tooltip"></i>
                        @else
                            <i class="mdi mdi-close-circle  user-status text-danger" title="Пользователь удален" data-toggle="tooltip"></i>
                        @endif
                    </div>
                    <div class="media-body">
                        <h4 class="m-t-5 @if($user->getFullName()) m-b-0 @else m-b-5 @endif ellipsis">{{ $user->login }}</h4>
                        @if($user->getFullName())
                            <p class="font-13 m-b-5">{{ $user->getFullName() }}</p>
                        @endif
                        <p class="m-b-5">
                            <span class="label @if($user->role == \App\Models\User::ROLE_ADMIN) label-success @elseif($user->role == \App\Models\User::ROLE_MODERATOR) label-info @else label-muted @endif m-b-10">
                                {{ \App\Models\User::$roles[$user->role] }}
                            </span>
                        </p>
                        <p class="text-muted m-b-0"><small>{{ $user->email }}</small></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-right">
                        <!-- Edit -->
                        @if(Auth::user()->hasAdminPermission() || Auth::user()->is($user))
                            <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-success waves-effect waves-light">
                                <i class="mdi mdi-account-settings-variant m-r-5"></i> Редактировать профиль
                            </a>
                        @endif
                        <div class="clearfix"></div>
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
        </div>
        <!--/ meta -->
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-md-4">
        <!-- Personal-Information -->
        @if($user->description)
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Подробрая информация</h3>
            </div>
            <div class="panel-body">
                @if($user->description)
                    <p class="text-muted font-13">
                        {!! $user->description !!}
                    </p>
                @endif

                {{--<hr/>--}}
                {{--<div class="text-left">--}}
                    {{--<p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">Johnathan Deo</span></p>--}}

                    {{--<p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">(+12) 123 1234 567</span></p>--}}

                    {{--<p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">coderthemes@gmail.com</span></p>--}}

                    {{--<p class="text-muted font-13"><strong>Location :</strong> <span class="m-l-15">USA</span></p>--}}

                    {{--<p class="text-muted font-13"><strong>Languages :</strong>--}}
                        {{--<span class="m-l-5">--}}
                            {{--<span class="flag-icon flag-icon-us m-r-5 m-t-0" title="us"></span>--}}
                            {{--<span>English</span>--}}
                        {{--</span>--}}
                        {{--<span class="m-l-5">--}}
                            {{--<span class="flag-icon flag-icon-de m-r-5" title="de"></span>--}}
                            {{--<span>German</span>--}}
                        {{--</span>--}}
                        {{--<span class="m-l-5">--}}
                            {{--<span class="flag-icon flag-icon-es m-r-5" title="es"></span>--}}
                            {{--<span>Spanish</span>--}}
                        {{--</span>--}}
                        {{--<span class="m-l-5">--}}
                            {{--<span class="flag-icon flag-icon-fr m-r-5" title="fr"></span>--}}
                            {{--<span>French</span>--}}
                        {{--</span>--}}
                    {{--</p>--}}
                {{--</div>--}}

                {{--<ul class="social-links list-inline m-t-20 m-b-0">--}}
                    {{--<li>--}}
                        {{--<a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            </div>
        </div>
        @endif
        <!-- Personal-Information -->

        {{--<div class="card-box ribbon-box">--}}
            {{--<div class="ribbon ribbon-primary">Messages</div>--}}
            {{--<div class="clearfix"></div>--}}
            {{--<div class="inbox-widget">--}}
                {{--<a href="#">--}}
                    {{--<div class="inbox-item">--}}
                        {{--<div class="inbox-item-img"><img src="/backend/images/users/avatar-2.jpg" class="img-circle" alt=""></div>--}}
                        {{--<p class="inbox-item-author">Tomaslau</p>--}}
                        {{--<p class="inbox-item-text">I've finished it! See you so...</p>--}}
                        {{--<p class="inbox-item-date m-t-10">--}}
                            {{--<button type="button" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> Reply </button>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
                {{--<a href="#">--}}
                    {{--<div class="inbox-item">--}}
                        {{--<div class="inbox-item-img"><img src="/backend/images/users/avatar-3.jpg" class="img-circle" alt=""></div>--}}
                        {{--<p class="inbox-item-author">Stillnotdavid</p>--}}
                        {{--<p class="inbox-item-text">This theme is awesome!</p>--}}
                        {{--<p class="inbox-item-date m-t-10">--}}
                            {{--<button type="button" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> Reply </button>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
                {{--<a href="#">--}}
                    {{--<div class="inbox-item">--}}
                        {{--<div class="inbox-item-img"><img src="/backend/images/users/avatar-4.jpg" class="img-circle" alt=""></div>--}}
                        {{--<p class="inbox-item-author">Kurafire</p>--}}
                        {{--<p class="inbox-item-text">Nice to meet you</p>--}}
                        {{--<p class="inbox-item-date m-t-10">--}}
                            {{--<button type="button" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> Reply </button>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</a>--}}

                {{--<a href="#">--}}
                    {{--<div class="inbox-item">--}}
                        {{--<div class="inbox-item-img"><img src="/backend/images/users/avatar-5.jpg" class="img-circle" alt=""></div>--}}
                        {{--<p class="inbox-item-author">Shahedk</p>--}}
                        {{--<p class="inbox-item-text">Hey! there I'm available...</p>--}}
                        {{--<p class="inbox-item-date m-t-10">--}}
                            {{--<button type="button" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> Reply </button>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
                {{--<a href="#">--}}
                    {{--<div class="inbox-item">--}}
                        {{--<div class="inbox-item-img"><img src="/backend/images/users/avatar-6.jpg" class="img-circle" alt=""></div>--}}
                        {{--<p class="inbox-item-author">Adhamdannaway</p>--}}
                        {{--<p class="inbox-item-text">This theme is awesome!</p>--}}
                        {{--<p class="inbox-item-date m-t-10">--}}
                            {{--<button type="button" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> Reply </button>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}

    </div>


    {{--<div class="col-md-8">--}}

        {{--<div class="row">--}}

            {{--<div class="col-sm-4">--}}
                {{--<div class="card-box widget-box-four m-b-20">--}}
                    {{--<div id="dashboard-1" class="widget-box-four-chart"></div>--}}
                    {{--<div class="wigdet-four-content pull-left">--}}
                        {{--<h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Total Revenue</h4>--}}
                        {{--<p class="font-secondary text-muted">Jan - Apr 2017</p>--}}
                        {{--<h3 class="m-b-0 m-t-20"><span>$</span> <span data-plugin="counterup">1,28,5960</span></h3>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
            {{--</div><!-- end col -->--}}

            {{--<div class="col-sm-4">--}}
                {{--<div class="card-box widget-box-four m-b-20">--}}
                    {{--<div id="dashboard-2" class="widget-box-four-chart"></div>--}}
                    {{--<div class="wigdet-four-content pull-left">--}}
                        {{--<h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Unique Visitors">Total Unique Visitors</h4>--}}
                        {{--<p class="font-secondary text-muted">Jan - Apr 2017</p>--}}
                        {{--<h3 class="m-b-0 m-t-20"><span>$</span> <span data-plugin="counterup">1,28,5960</span></h3>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
            {{--</div><!-- end col -->--}}

            {{--<div class="col-sm-4">--}}
                {{--<div class="card-box widget-box-four m-b-20">--}}
                    {{--<div id="dashboard-3" class="widget-box-four-chart"></div>--}}
                    {{--<div class="wigdet-four-content pull-left">--}}
                        {{--<h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Number of Transactions">Number of Transactions</h4>--}}
                        {{--<p class="font-secondary text-muted">Jan - Apr 2017</p>--}}
                        {{--<h3 class="m-b-0 m-t-20"><span>$</span> <span data-plugin="counterup">1,28,5960</span></h3>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
            {{--</div><!-- end col -->--}}

        {{--</div>--}}
        {{--<!-- end row -->--}}

        {{--<div class="card-box">--}}
            {{--<div class="table-responsive">--}}
                {{--<table class="table m-b-0">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>#</th>--}}
                        {{--<th>Project Name</th>--}}
                        {{--<th>Start Date</th>--}}
                        {{--<th>Due Date</th>--}}
                        {{--<th>Status</th>--}}
                        {{--<th>Assign</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                        {{--<td>1</td>--}}
                        {{--<td>Adminox Admin</td>--}}
                        {{--<td>01/01/2015</td>--}}
                        {{--<td>07/05/2015</td>--}}
                        {{--<td><span class="label label-info">Work in Progress</span></td>--}}
                        {{--<td>Coderthemes</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>2</td>--}}
                        {{--<td>Adminox Frontend</td>--}}
                        {{--<td>01/01/2015</td>--}}
                        {{--<td>07/05/2015</td>--}}
                        {{--<td><span class="label label-success">Pending</span></td>--}}
                        {{--<td>Coderthemes</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>3</td>--}}
                        {{--<td>Adminox Admin</td>--}}
                        {{--<td>01/01/2015</td>--}}
                        {{--<td>07/05/2015</td>--}}
                        {{--<td><span class="label label-pink">Done</span></td>--}}
                        {{--<td>Coderthemes</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>4</td>--}}
                        {{--<td>Adminox Frontend</td>--}}
                        {{--<td>01/01/2015</td>--}}
                        {{--<td>07/05/2015</td>--}}
                        {{--<td><span class="label label-purple">Work in Progress</span></td>--}}
                        {{--<td>Coderthemes</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>5</td>--}}
                        {{--<td>Adminox Admin</td>--}}
                        {{--<td>01/01/2015</td>--}}
                        {{--<td>07/05/2015</td>--}}
                        {{--<td><span class="label label-warning">Coming soon</span></td>--}}
                        {{--<td>Coderthemes</td>--}}
                    {{--</tr>--}}

                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</div>--}}
    <!-- end col -->

</div>
<!-- end row -->

@endsection

@push('styles')
<!-- Sweet Alert -->
<link href="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
<!-- Sweet-Alert  -->
<script src="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    $(document).ready(function () {

        /* Deleting users :mark user as deleted */
        $(document).on('click', '.button-delete', function (e) {
            var $button = $(this),
                itemId = $(this).data('itemId'),
                itemTitle = $(this).data('itemTitle'),
                hasActivities = $(this).data('hasActivities');
            var text = '';
            if(hasActivities) {
                text = text + '\n Пользователь будет отмечен удаленным, активность пользователя возможно будет восстановить.';
            } else {
                text = text + '\n Пользователь будет безвозвратно удален с сайта.'
            }

            swal({
                title: "Удалить пользователя?",
                text: 'Вы точно хотите удалить пользователя '+ itemTitle +'?' + text,
                type: "error",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Удалить'
            }).then(function() {
                $.ajax({
                    url: "/admin/users/" + itemId,
                    dataType: "text json",
                    type: "DELETE",
                    data: {},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        if (response.success) {
                            notification(response.message, 'success');

                            $button.toggleClass('button-undelete').toggleClass('button-delete')
                                .toggleClass('text-success').toggleClass('text-danger')
                                .text('Восстановить');
                            $('.user-avatar .user-status').toggleClass('text-success').toggleClass('text-danger')
                                .toggleClass('mdi-account-circle').toggleClass('mdi-close-circle')
                                .attr('data-original-title', 'Пользователь удален');
                        } else {
                            notification(response.message, 'warning');
                        }
                    }
                });
            }, function(dismiss) {});
        });

        /* Deleting users :mark user as undeleted */
        $(document).on('click', '.button-undelete', function (e) {
            var $button = $(this),
                itemId = $(this).data('itemId'),
                itemTitle = $(this).data('itemTitle');

            swal({
                title: "Восстановить пользователя?",
                text: 'Вы точно хотите восстановить активность пользователя '+ itemTitle +'?',
                type: "success",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-success',
                confirmButtonText: 'Восстановить'
            }).then(function() {
                $.ajax({
                    url: "/admin/users/undelete/" + itemId,
                    dataType: "text json",
                    type: "POST",
                    data: {},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {
                        if (response.success) {
                            notification(response.message, 'success');

                            $button.toggleClass('button-undelete').toggleClass('button-delete')
                                .toggleClass('text-success').toggleClass('text-danger')
                                .text('Удалить');
                            $('.user-avatar .user-status').toggleClass('text-success').toggleClass('text-danger')
                                .toggleClass('mdi-account-circle').toggleClass('mdi-close-circle')
                                .attr('data-original-title', 'Пользователь активен');
                        } else {
                            notification(response.message, 'warning');
                        }
                    }
                });
            }, function(dismiss) {});
        });
    });
</script>
@endpush