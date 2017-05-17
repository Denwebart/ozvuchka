<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Редактирование страницы</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('admin.index') }}">Главная</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.index') }}">Страницы</a>
                    </li>
                    <li class="active">
                        Редактирование страницы
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    

@endsection

@push('styles')
<!-- DataTables -->
<link href="{{ asset('backend/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable({
            "language": {
                "url": "/backend/plugins/datatables/dataTables.russian.json"
            },
            "stateSave": true
        });
    });
</script>
@endpush