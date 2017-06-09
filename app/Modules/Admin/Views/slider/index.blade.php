<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="card-box m-b-20">

    <h4 class="header-title m-t-0">Слайдер</h4>
    <p class="text-muted font-13 m-b-15">
        Слайдер на главной странице сайта
    </p>
    <p class="text-muted font-13 m-b-30">
        Слайд будет отображен только в том случае,
        если загружено изображение и статус публикации "Опубликован".
    </p>

    <div id="slider">
        <div class="slider-body slider-items">
            @include('admin::slider.items', ['slider' => \App\Models\Slider::all()])
        </div>
        <div class="slider-bottom m-b-10">
            <div class="slider-control-buttons pull-right m-t-10">
                <a href="#" class="open-slider-form pull-right m-r-15" data-toggle="tooltip" title="Добавить слайд">
                    <span class="m-r-5 pull-left">Добавить слайд</span>
                    <i class="mdi mdi-playlist-plus font-18 pull-left"></i>
                </a>
            </div>
            <div class="clearfix"></div>

            <!-- Form for added new slide -->
            <div class="new-slide-form m-t-10 m-b-10" style="display: none">
                {!! Form::open(['url' => route('admin.slider.store'), 'id' => 'new-slide-form', 'class' => 'form-horizontal']) !!}
                <p class="text-muted font-13">
                    Создание нового слайда.
                </p>
                <div class="row">
                    <div class="col-sm-4 m-t-5">
                        {!! Form::file('image', ['id' => 'image', 'class' => 'dropify', 'data-default-file' => false, 'data-height' => '120px', 'data-max-file-size' => '3M']) !!}
                        <span class="help-block error image_error text-danger font-12" style="display: none">
                            <i class="fa fa-times-circle"></i>
                            <strong></strong>
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Заголовок:</b>
                            {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control maxlength', 'maxlength' => 255]) !!}
                            <span class="help-block error title_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Текст:</b>
                            {!! Form::textarea('text', null, ['id' => 'text', 'class' => 'form-control maxlength', 'maxlength' => 255, 'rows' => 2]) !!}
                            <span class="help-block error text_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Кнопка:</b>
                            {!! Form::text('button_text', null, ['id' => 'button_text', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                            <span class="help-block error button_text_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Ссылка:</b>
                            {!! Form::text('button_link', null, ['id' => 'button_link', 'class' => 'form-control maxlength', 'maxlength' => 255]) !!}
                            <span class="help-block error button_link_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">
                                Альт:
                                <!-- Info text: image_alt -->
                                <span class="m-l-10 text-muted help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-content="ALT - это краткое и правдивое описание изображения. Обязательно должен содержать важные ключевые фразы для продвижения изображения (не страницы). Рекомендуемая длина не менее 3-4 слов и не более 255 символов. Поисковики учитывают не весь ALT, а лишь несколько первых слов. Для Google лимит 16 слов, для Яндекса – 28 слов." data-original-title="Атрибут ALT для изображения">
                                    <i class="fa fa-question-circle-o"></i>
                                </span>
                            </b>
                            {!! Form::textarea('image_alt', null, ['id' => 'image_alt', 'class' => 'form-control maxlength', 'maxlength' => 255, 'rows' => 2]) !!}
                            <span class="help-block error image_alt_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <div class="switchery-demo m-t-10 text-right">
                            {!! Form::hidden('is_published', 0) !!}
                            {!! Form::checkbox('is_published', 1, 1, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="button-add-slide btn btn-custom waves-effect waves-light pull-right">Создать</button>
                    </div>
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
<!-- Bootstrap MaxLength -->
<script src="{{ asset('backend/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endpush

@push('scriptsBottom')
<script type="text/javascript">
    // Bootstrap MaxLength
    $(".maxlength").maxlength({
        alwaysShow: true
    });

    // Change position
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

    // Init plugins after ajax
    function initPluginsAfterAjax() {
        $(".sortable-slider").sortable(sliderSortableOptions);
        initDropifyAjax();
        $('.editable-text').editable(getSettingsEditableOptions());
        $('#slider .slider-items').find('[data-plugin="switchery"]').each(function (i, o) {
            new Switchery($(this)[0], $(this).data())
        })
        $('[data-toggle="tooltip"]').tooltip();

        // init tooltips, switchery
//        $.Components.init();
    };

    // Delete item
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

                        initPluginsAfterAjax();
                    } else {
                        notification(response.message, 'error');
                    }
                },
            });
        }, function(dismiss) {});
    });

    // Add new slider item: open form for added new item
    $('#slider').on('click', '.open-slider-form', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var $form = $('.new-slide-form');
        if($form.is(':visible')) {
            $form.hide();
        } else {
            $form.show();
            $('html, body').animate({
                scrollTop: $('.new-slide-form').offset().top - 120
            }, 1000);
        }
    });

    var dropify = $('.dropify').dropify(dropifyOptions);

    // Add new slider item: add new item
    $('#new-slide-form').on('submit', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var $form = $(this),
            formData = new FormData(),
            params   = $form.serializeArray(),
            image    = $form.find('[name="image"]')[0].files[0],
            url = $form.attr('action');

        $.each(params, function(i, val) {
            formData.append(val.name, val.value);
        });
        if(image) {
            formData.append('image', image);
        }

        $.ajax({
            data: formData,
            type: 'POST',
            dataType: "json",
            processData: false,
            contentType: false,
            url: url,
            beforeSend: function(request) {
                $form.find('.error').hide().find('strong').text('');
                $form.find('.has-error').removeClass('has-error');
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response) {
                if(response.success) {
                    notification(response.message, 'success');

                    $('#slider .slider-items').html(response.resultHtml);
                    $('.new-slide-form').hide();
                    $('html, body').animate({
                        scrollTop: $('.slide-item[id="' + response.itemId + '"]').offset().top - 50
                    }, 1000);

                    $form.trigger('reset');
                    var drEvent = $form.find('.dropify').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    var dropify = $('.dropify').dropify(dropifyOptions);

                    initPluginsAfterAjax();
                } else {
                    notification(response.message, 'error');

                    $.each(response.errors, function(index, value) {
                        var errorDiv = '.' + index + '_error';
                        $form.find(errorDiv).parent().addClass('has-error');
                        $form.find(errorDiv).show().find('strong').text(value);
                    });
                }
            }
        });
    });
</script>
@endpush