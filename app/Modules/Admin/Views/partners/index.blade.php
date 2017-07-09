<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="card-box m-b-20">

    <h4 class="header-title m-t-0">Партнеры</h4>
    <p class="text-muted font-13 m-b-20">
        Виджет отображается на странице
        @php $page = \App\Models\Page::find(\App\Models\Page::ID_PARTNERS_PAGE) @endphp
        "<a href="{{ $page->getUrl() }}" target="_blank" rel="nofollow, noopener">{{ $page->getTitle() }}</a>".
    </p>

    <div id="partners">
        <div class="partners-body partners-items">
            @include('admin::partners.items', ['partners' => \App\Models\Partner::all()])
        </div>
        <div class="partners-bottom m-b-10">
            <div class="partners-control-buttons pull-right m-t-10">
                <a href="#" class="open-partner-form pull-right m-r-15" data-toggle="tooltip" title="Добавить партнера">
                    <span class="m-r-5 pull-left">Добавить партнера</span>
                    <i class="mdi mdi-playlist-plus font-18 pull-left"></i>
                </a>
            </div>
            <div class="clearfix"></div>

            <!-- Form for added new partner -->
            <div class="new-partner-form m-t-10 m-b-10" style="display: none">
                {!! Form::open(['url' => route('admin.partners.store'), 'id' => 'new-partner-form', 'class' => 'form-horizontal']) !!}
                <p class="text-muted font-13">
                    Добавление нового партнера.
                </p>
                <div class="row">
                    <div class="col-sm-4 m-t-5">
                        {!! Form::file('image', ['id' => 'image', 'class' => 'dropify', 'data-default-file' => false, 'data-height' => '120px', 'data-max-file-size' => '3M', 'data-min-width' => '339', 'data-min-height' => '339']) !!}
                        <span class="help-block error image_error text-danger font-12" style="display: none">
                            <i class="fa fa-times-circle"></i>
                            <strong></strong>
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Заголовок:</b>
                            {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                            <span class="help-block error title_error text-danger font-12" style="display: none">
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
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Описание:</b>
                            {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control maxlength', 'maxlength' => 1000, 'rows' => 2]) !!}
                            <span class="help-block error description_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </p>
                        <div class="social-links">
                            <h4 class="header-title open-social-links-form">
                                <a href="#" class="m-r-10 text-muted">Социальные сети</a>
                                <a href="#" title="Добавить" data-toggle="tooltip">
                                    <i class="fa fa-plus m-l-10"></i>
                                </a>
                            </h4>
                            <div class="social-links-form" style="display: none">
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Сайт:</b>
                                    {!! Form::text('link_website', null, ['id' => 'link_website', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                                    <span class="help-block error link_website_error text-danger font-12" style="display: none">
                                        <i class="fa fa-times-circle"></i>
                                        <strong></strong>
                                    </span>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">VK:</b>
                                    {!! Form::text('link_vk', null, ['id' => 'link_vk', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                                    <span class="help-block error link_vk_error text-danger font-12" style="display: none">
                                        <i class="fa fa-times-circle"></i>
                                        <strong></strong>
                                    </span>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Facebook:</b>
                                    {!! Form::text('link_facebook', null, ['id' => 'link_facebook', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                                    <span class="help-block error link_facebook_error text-danger font-12" style="display: none">
                                        <i class="fa fa-times-circle"></i>
                                        <strong></strong>
                                    </span>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Instagram:</b>
                                    {!! Form::text('link_instagram', null, ['id' => 'link_instagram', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                                    <span class="help-block error link_instagram_error text-danger font-12" style="display: none">
                                        <i class="fa fa-times-circle"></i>
                                        <strong></strong>
                                    </span>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Twitter:</b>
                                    {!! Form::text('link_twitter', null, ['id' => 'link_twitter', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                                    <span class="help-block error link_twitter_error text-danger font-12" style="display: none">
                                        <i class="fa fa-times-circle"></i>
                                        <strong></strong>
                                    </span>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Google:</b>
                                    {!! Form::text('link_google', null, ['id' => 'link_google', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                                    <span class="help-block error link_google_error text-danger font-12" style="display: none">
                                        <i class="fa fa-times-circle"></i>
                                        <strong></strong>
                                    </span>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">YouTube:</b>
                                    {!! Form::text('link_youtube', null, ['id' => 'link_youtube', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                                    <span class="help-block error link_youtube_error text-danger font-12" style="display: none">
                                        <i class="fa fa-times-circle"></i>
                                        <strong></strong>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="switchery-demo m-t-10 text-right">
                            {!! Form::hidden('is_published', 0) !!}
                            {!! Form::checkbox('is_published', 1, 1, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-custom waves-effect waves-light pull-right">Создать</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

@push('scriptsBottom')
<script type="text/javascript">
    // Bootstrap MaxLength
    $(".maxlength").maxlength({
        alwaysShow: true
    });

    // Open partner social links form
    $('#partners').on('click', '.open-social-links-form', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
        var itemId = $(this).data('id'),
            $form = $('#partners .social-links-form');
        if(itemId) {
            $form = $('#partners .social-links-form-' + itemId);
        }
        if($form.is(':visible')) {
            $form.hide();
        } else {
            $("[class^='social-links-form']").hide();
            $form.show();
            $('html, body').animate({
                scrollTop: $(this).offset().top - 190
            }, 1000);
        }
    });

    // Change position
    var partnersSortableOptions = {
        cursor: 'move',
        axis: 'y',
        update: function (event, ui) {
            var positions = $(this).sortable('toArray');
            $.ajax({
                data: {positions: positions},
                type: 'POST',
                url: '{{ route('admin.partners.position') }}',
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
    $(".sortable-partners").sortable(partnersSortableOptions);

    // Init plugins after ajax
    function initPluginsAfterAjaxPartners() {
        $(".sortable-partners").sortable(partnersSortableOptions);
        initDropifyAjax();
        $('.editable-text').editable(getSettingsEditableOptions());
        $('#partners .partners-items').find('[data-plugin="switchery"]').each(function (i, o) {
            new Switchery($(this)[0], $(this).data())
        })
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

        // init tooltips, switchery
//        $.Components.init();
    };

    // Delete item
    $('#partners').on('click', '.delete-item', function(e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var itemId = $(this).data('itemId');

        swal({
            title: "Удалить партнера?",
            text: 'Вы точно хотите удалить безвозвратно этого партнера?',
            type: "error",
            showCancelButton: true,
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Удалить'
        }).then(function() {
            $.ajax({
                data: {},
                type: 'DELETE',
                url: "/admin/partners/" + itemId,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success) {
                        notification(response.message, 'success');

                        $('#partners .partners-items').html(response.resultHtml);

                        initPluginsAfterAjaxPartners();
                    } else {
                        notification(response.message, 'error');
                    }
                },
            });
        }, function(dismiss) {});
    });

    // Add new partner: open form for added new item
    $('#partners').on('click', '.open-partner-form', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var $form = $('.new-partner-form');
        if($form.is(':visible')) {
            $form.hide();
        } else {
            $form.show();
            $('html, body').animate({
                scrollTop: $('.new-partner-form').offset().top - 120
            }, 1000);
        }
    });

    var dropify = $('.dropify').dropify(dropifyOptions);

    // Add new partner: add new item
    $('#new-partner-form').on('submit', function (e) {
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

                    $('#partners .partners-items').html(response.resultHtml);
                    $('.new-partner-form').hide();
                    $('html, body').animate({
                        scrollTop: $('.partners-item[id="' + response.itemId + '"]').offset().top - 100
                    }, 1000);

                    $form.trigger('reset');
                    var drEvent = $form.find('.dropify').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    var dropify = $('.dropify').dropify(dropifyOptions);

                    initPluginsAfterAjaxPartners();
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