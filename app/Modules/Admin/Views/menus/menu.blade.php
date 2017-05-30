<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="card-box m-b-20">

    <h4 class="header-title m-t-0 m-b-20">Меню сайта</h4>
    <p class="text-muted font-13 m-b-15">
        Правый клик мыши на пункте меню для редактирования или удаления. <br>
        Зажать и перетащить пункт меню для смены порядка.
    </p>

    <div id="menus">
        @foreach(\App\Models\Menu::$types as $menuType => $menuTitle)
            <div class="menu">
                <div class="menu-heading m-b-10">
                    <h5 class="header-title m-b-0 pull-left">
                        {{ $menuTitle }}
                    </h5>
                    <div class="menu-control-buttons pull-right m-t-10">
                        <a href="#" class="open-menu-item-form pull-right m-r-15" data-menu-type="{{ $menuType }}" data-toggle="tooltip" title="Добавить пункт меню">
                            <i class="mdi mdi-playlist-plus font-18"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- Form for added new menu item -->
                    <div class="new-menu-item-form m-t-10 m-b-10" data-menu-type="{{ $menuType }}" style="display: none">
                        {!! Form::open(['url' => route('admin.menus.add'), 'class' => 'form-horizontal']) !!}
                        <p class="text-muted font-13">
                            Начните вводить заголовок страницы, которую необходимо добавить в меню.
                        </p>
                        <div class="input-group">
                            <input type="text" id="new-item-in-menu-{{ $menuType }}" name="new-item-in-menu-{{ $menuType }}" class="form-control" placeholder="Заголовок страницы">
                            <span class="input-group-btn">
                                <button type="button" class="add-menu-item btn btn-custom waves-effect waves-light" data-menu-type="{{ $menuType }}">Добавить</button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="menu-body menu-items" data-menu-type="{{ $menuType }}">
                    @include('admin::menus.items', ['items' => isset($menuItems[$menuType]) ? $menuItems[$menuType] : []])
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<!-- Sweet Alert -->
<link href="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
<!-- Sweet-Alert  -->
<script src="{{ asset('backend/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<!-- For Sortable -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Autocomplete -->
<script type="text/javascript" src="{{ asset('backend/plugins/autocomplete/jquery.autocomplete.min.js') }}"></script>
@endpush

@push('scriptsBottom')
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

        swal({
            title: "Удалить пункт меню?",
            text: 'Вы точно хотите удалить пункт меню "'+ itemTitle +'" из меню "'+ menuTitle +'"?',
            type: "error",
            showCancelButton: true,
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Удалить'
        }).then(function() {
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
        }, function(dismiss) {});
    });

    /* Add new menu item: open form for added new item */
    $('#menus').on('click', '.open-menu-item-form', function (e) {
        e.preventDefault();
        var menuType = $(this).data('menuType'),
            $form = $('.new-menu-item-form[data-menu-type='+ menuType +']');
        if($form.is(':visible')) {
            $form.hide()
                .find('input').removeAttr('data-page-id').val('');
        } else {
            $('.new-menu-item-form').hide()
                .find('input').removeAttr('data-page-id').val('');
            $form.show();
        }
    });

    /* Add new menu item: autocomplete for search page for added new item */
    $('[id^="new-item-in-menu-"]').autocomplete({
        serviceUrl: "<?php echo URL::route('admin.menus.autocomplete') ?>",
        minChars: 2,
        onSelect: function(suggestion) {
            $(this).val(suggestion.value)
                .data('pageId', suggestion.data);
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

                    input.removeAttr('data-page-id').val('');

                    $('.menu-items[data-menu-type='+ menuType +']').html(response.menuItemsHtml);
                    $(".sortable, .sortable-sublist").sortable(sortableOptions);
                    $('.editable-menu-item').editable(getMenuEditableOptions());
                } else {
                    notification(response.message, 'error');

                    input.removeAttr('data-page-id').val('');
                }
            }
        });
    });

</script>
@endpush