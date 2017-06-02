<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<!-- Left sidebar -->
<div class="inbox-leftbar">

    <div class="mail-list">
        <a href="{{ route('admin.letters.index') }}" class="list-group-item b-0 @if(Request::is('admin/letters')) text-danger active @endif">
            <i class="mdi mdi-inbox font-18 vertical-middle m-r-10"></i>
            @if($newLetters = count(\App\Models\Letter::whereNull('read_at')->get()))
                <span class="badge badge-danger pull-right">{{ $newLetters }}</span>
            @endif
            Входящие
        </a>
        <a href="{{ route('admin.letters.important') }}" class="list-group-item b-0 @if(Request::is('admin/letters/important*')) text-danger active @endif">
            <i class="mdi mdi-star font-18 vertical-middle m-r-10"></i>
            Важные
        </a>
        <a href="{{ route('admin.letters.trash') }}" class="list-group-item b-0 @if(Request::is('admin/letters/trash*')) text-danger active @endif">
            <i class="mdi mdi-delete font-18 vertical-middle m-r-10"></i>
            Корзина
        </a>
    </div>

    {{--<h3 class="panel-title m-t-40 m-b-15">Теги</h3>--}}

    {{--<div class="list-group b-0 mail-list">--}}
        {{--<a href="#" class="list-group-item b-0"><span class="fa fa-circle text-info m-r-10"></span>Тег 1</a>--}}
        {{--<a href="#" class="list-group-item b-0"><span class="fa fa-circle text-warning m-r-10"></span>Тег 2</a>--}}
        {{--<a href="#" class="list-group-item b-0"><span class="fa fa-circle text-purple m-r-10"></span>Тег 3</a>--}}
        {{--<a href="#" class="list-group-item b-0"><span class="fa fa-circle text-pink m-r-10"></span>Тег 4</a>--}}
        {{--<a href="#" class="list-group-item b-0"><span class="fa fa-circle text-success m-r-10"></span>Тег 5</a>--}}
    {{--</div>--}}

</div>
<!-- End Left sidebar -->