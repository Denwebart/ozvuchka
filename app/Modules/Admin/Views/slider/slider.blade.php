<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="card-box m-b-20">

    <h4 class="header-title m-t-0 m-b-20">Слайдер</h4>
    <p class="text-muted font-13 m-b-15">
        Слайдер на главной странице сайта
    </p>

    <div id="slider">
        <div class="slider-body slider-items">
            @include('admin::slider.items', ['slider' => \App\Models\Slider::all()])
        </div>
        <div class="slider-heading m-b-10">
            <div class="slider-control-buttons pull-right m-t-10">
                <a href="#" class="open-slider-form pull-right m-r-15" data-toggle="tooltip" title="Добавить слайд">
                    <i class="mdi mdi-playlist-plus font-18"></i>
                </a>
            </div>
            <div class="clearfix"></div>

            <!-- Form for added new slide -->
            <div class="new-slide-form m-t-10 m-b-10" style="display: none">
                {!! Form::open(['url' => route('admin.slider.create'), 'class' => 'form-horizontal']) !!}
                <p class="text-muted font-13">
                    ...
                </p>
                <div class="input-group">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Заголовок слайда">
                    <span class="input-group-btn">
                        <button type="button" class="add-slide btn btn-custom waves-effect waves-light">Добавить</button>
                    </span>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="clearfix"></div>
        </div>
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
    var sliderSortableOptions = {
        cursor: 'move',
        axis: 'y',
        update: function (event, ui) {
            var positions = $(this).sortable('toArray');
            $.ajax({
                data: {positions: positions},
                type: 'POST',
                url: '{{ route('admin.slider.position') }}',
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
    $(".sortable-slider").sortable(sliderSortableOptions);

    /* Remame item */
    function getSliderEditableOptions() {
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
                    $('.editable-slider-item[data-page-id='+ response.pageId +']')
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
    $('.editable-slider-item').editable(getSliderEditableOptions());

    /* Delete item */
    $('#slider').on('click', '.delete-item', function(e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var itemId = $(this).data('itemId');

        swal({
            title: "Удалить слайд?",
            text: 'Вы точно хотите удалить безвозвратно этот слайд?',
            type: "error",
            showCancelButton: true,
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Удалить'
        }).then(function() {
            $.ajax({
                data: {},
                type: 'DELETE',
                url: "/admin/slider/" + itemId,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success) {
                        notification(response.message, 'success');

                        $('#slider .slider-items').html(response.resultHtml);
                        $(".sortable, .sortable-sublist").sortable(sliderSortableOptions);
                        $('.editable-slider-item').editable(getSliderEditableOptions());
                    } else {
                        notification(response.message, 'error');
                    }
                },
            });
        }, function(dismiss) {});
    });

    /* Add new menu item: open form for added new item */
    $('#slider').on('click', '.open-slider-form', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var $form = $('.new-slide-form');
        if($form.is(':visible')) {
            $form.hide()
                .find('input').removeAttr('data-page-id').val('');
        } else {
            $('.new-menu-item-form').hide()
                .find('input').removeAttr('data-page-id').val('');
            $form.show();
        }
    });

    /* Add new menu item: add new item */
    $('#slider').on('click', '.add-slide', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var input = $('[name^="new-slide]'),
            pageTitle = input.val();

        $.ajax({
            data: {},
            type: 'PUT',
            url: '{{ route('admin.slider.create') }}',
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response) {
                if(response.success) {
                    notification(response.message, 'success');

                    $('.menu-items[data-menu-type='+ menuType +']').html(response.menuItemsHtml);
                    $(".sortable, .sortable-sublist").sortable(sliderSortableOptions);
                    $('.editable-slider-item').editable(getSliderEditableOptions());
                } else {
                    notification(response.message, 'error');
                }
            }
        });
    });

</script>
@endpush