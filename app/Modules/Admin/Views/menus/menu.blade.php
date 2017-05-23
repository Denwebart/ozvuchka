<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<h4 class="header-title m-t-0 m-b-20">Меню сайта</h4>
<p class="text-muted font-13 m-b-15">
    Правый клик мыши на пункте меню для редактирования или удаления. <br>
    Зажать и перетащить пункт меню для смены порядка.
</p>

<div id="menus" class="row">
    @foreach(\App\Models\Menu::$types as $menuType => $menuTitle)
        <div class="col-md-12 col-sm-12 col-xs-12 bg-muted m-b-10">
            <h5 class="m-t-10 m-b-10">
                {{ $menuTitle }}
                <a href="#" class="pull-right open-menu-item-form" data-menu-type="{{ $menuType }}" data-toggle="tooltip" title="Добавить пункт меню">
                    Добавить пункт меню
                    <i class="fa fa-plus m-l-5"></i>
                </a>
            </h5>
            <div class="new-menu-item-form m-b-20" data-menu-type="{{ $menuType }}" style="display: none">
                {!! Form::open(['url' => route('admin.menus.add'), 'class' => 'form-horizontal m-t-10']) !!}
                    <p class="text-muted font-13 m-b-15">
                        Начните вводить заголовок страницы, которую необходимо добавить в меню.
                    </p>
                    <div class="input-group m-t-10">
                        <input type="text" id="new-item-in-menu-{{ $menuType }}" name="new-item-in-menu-{{ $menuType }}" class="form-control" placeholder="Заголовок страницы">
                        <span class="input-group-btn">
                            <button type="button" class="add-menu-item btn waves-effect waves-light btn-primary" data-menu-type="{{ $menuType }}">Добавить</button>
                        </span>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="menu-items col-md-12 col-sm-12 col-xs-12" data-menu-type="{{ $menuType }}">
            @include('admin::menus.items', ['items' => isset($menuItems[$menuType]) ? $menuItems[$menuType] : []])
        </div>
    @endforeach
</div>

@push('styles')
<!-- Sweet Alert -->
<link href="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
<!-- Sweet-Alert  -->
<script src="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">

    /* Change position */
    var sortableOptions = {
        cursor: 'move',
        axis: 'y',
        update: function (event, ui) {
            var positions = $(this).sortable('toArray');
            var menuType = $(ui.item).data('menu-type');
            $.ajax({
                data: {positions: positions, menuType: menuType},
                type: 'POST',
                url: '{{ route('admin.menus.position') }}',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success) {
                        notification(response.message, 'success');
                    } else {
                        notification(response.message, 'error');
                    }
                },
            });
        }
    };
    $(".sortable, .sortable-sublist").sortable(sortableOptions);

    /* Remame item */
    function getMenuEditableOptions() {
        return {
            url: "{{ route('admin.menus.rename') }}",
            mode: 'inline',
            prepend: false,
            clear: false,
            emptytext: 'не задано',
            ajaxOptions: {
                dataType: 'json',
                sourceCache: 'false',
                type: 'POST'
            },
            success: function(response, newValue) {
                if(response.success) {
                    notification(response.message, 'success');
                    $('.editable-menu-item[data-page-id='+ response.pageId +']')
                        .text(newValue);
                    return true;
                } else {
                    notification(response.message, 'error');
                    return response.error;
                }
                return false;
            }
        };
    }
    $('.editable-menu-item').editable(getMenuEditableOptions());

    /* Delete item */
    $('#menus').on('click', '.delete-item', function(e) {
        e.preventDefault();
        var menuType = $(this).data('menu-type'),
            menuTitle = $(this).data('menu-title'),
            itemId = $(this).data('item-id'),
            pageId = $(this).data('page-id'),
            itemTitle = $(this).data('itemTitle');

        sweetAlert(
            {
                title: "Удалить пункт меню?",
                text: 'Вы точно хотите удалить пункт меню "'+ itemTitle +'" из меню "'+ menuTitle +'"?',
                type: "error",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                confirmButtonText: 'Удалить'
            },
            function(){
                $.ajax({
                    data: {menuType: menuType, itemId: itemId},
                    type: 'POST',
                    url: '{{ route('admin.menus.delete') }}',
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success) {
                            notification(response.message, 'success');
                            $('.menu-items[data-menu-type='+ menuType +']').html(response.menuItemsHtml);
                            $(".sortable, .sortable-sublist").sortable(sortableOptions);
                            $('.editable-menu-item').editable(getMenuEditableOptions());
                        } else {
                            notification(response.message, 'error');
                        }
                    },
                });
            });
    });

    /* Add new menu item: open form for added new item */
    $('#menus').on('click', '.open-menu-item-form', function (e) {
        e.preventDefault();
        var menuType = $(this).data('menuType'),
            $form = $('.new-menu-item-form[data-menu-type='+ menuType +']');
        if($form.is(':visible')) {
            $form.hide();
        } else {
            $('.new-menu-item-form').hide();
            $form.show();
        }
    });

    /* Add new menu item: autocomplete for search page for added new item */
    $('[id^="new-item-in-menu-"]').autocomplete({
        source: "<?php echo URL::route('admin.menus.autocomplete') ?>",
        minLength: 2,
        select: function(e, ui) {
            $(this).val(ui.item.value);
            $(this).attr('data-page-id', ui.item.id);
        }
    });

    /* Add new menu item: add new item */
    $('#menus').on('click', '.add-menu-item', function (e) {
        e.preventDefault();

        var menuType = $(this).data('menuType'),
            input = $('[name^="new-item-in-menu-'+ menuType +'"]'),
            pageId = input.data('pageId'),
            pageTitle = input.val();

        $.ajax({
            data: {pageId: pageId, pageTitle: pageTitle, menuType: menuType},
            type: 'POST',
            url: '{{ route('admin.menus.add') }}',
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response) {
                if(response.success) {
                    notification(response.message, 'success');

                    input.removeAttr('data-page-id');
                    input.val('');

                    $('.menu-items[data-menu-type='+ menuType +']').html(response.menuItemsHtml);
                    $(".sortable, .sortable-sublist").sortable(sortableOptions);
                    $('.editable-menu-item').editable(getMenuEditableOptions());
                } else {
                    notification(response.message, 'error');

                    input.removeAttr('data-page-id');
                    input.val('');
                }
            }
        });
    });

</script>
@endpush