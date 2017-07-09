<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="card-box m-b-20">

    <h4 class="header-title m-t-0">Отзывы</h4>
    <p class="text-muted font-13 m-b-20">
        @php $page = \App\Models\Page::find(\App\Models\Page::ID_NEWS_PAGE) @endphp
        Виджет отображается на страницах, категории, странице
        "<a href="{{ $page->getUrl() }}" target="_blank" rel="nofollow, noopener">{{ $page->getTitle() }}</a>"
        и на страницах отдельной новости.
        <br>
        Количество выводимых отзывов: 3 шт.
    </p>

    <div id="reviews">
        <div class="reviews-body reviews-items">
            @include('admin::reviews.items', ['reviews' => \App\Models\Review::all()])
        </div>
        <div class="reviews-bottom m-b-10">
            <div class="reviews-control-buttons pull-right m-t-10">
                <a href="#" class="open-review-form pull-right m-r-15" data-toggle="tooltip" title="Добавить отзыв">
                    <span class="m-r-5 pull-left">Добавить отзыв</span>
                    <i class="mdi mdi-playlist-plus font-18 pull-left"></i>
                </a>
            </div>
            <div class="clearfix"></div>

            <!-- Form for added new review -->
            <div class="new-review-form m-t-10 m-b-10" style="display: none">
                {!! Form::open(['url' => route('admin.reviews.store'), 'id' => 'new-review-form', 'class' => 'form-horizontal']) !!}
                <p class="text-muted font-13">
                    Добавление нового отзыва.
                </p>
                <div class="row">
                    <div class="col-sm-4 m-t-5">
                        {!! Form::file('user_avatar', ['id' => 'user_avatar', 'class' => 'dropify', 'data-default-file' => false, 'data-height' => '120px', 'data-max-file-size' => '3M', 'data-min-width' => '49', 'data-min-height' => '49']) !!}
                        <span class="help-block error user_avatar_error text-danger font-12" style="display: none">
                            <i class="fa fa-times-circle"></i>
                            <strong></strong>
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Имя:</b>
                            {!! Form::text('user_name', null, ['id' => 'user_name', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}
                            <span class="help-block error user_name_error text-danger font-12" style="display: none">
                                <i class="fa fa-times-circle"></i>
                                <strong></strong>
                            </span>
                        </p>
                        {{--<p>--}}
                            {{--<b class="font-13 text-muted" style="width: 75px; display: inline-block">Email:</b>--}}
                            {{--{!! Form::text('user_email', null, ['id' => 'user_email', 'class' => 'form-control maxlength', 'maxlength' => 100]) !!}--}}
                            {{--<span class="help-block error user_email_error text-danger font-12" style="display: none">--}}
                                {{--<i class="fa fa-times-circle"></i>--}}
                                {{--<strong></strong>--}}
                            {{--</span>--}}
                        {{--</p>--}}
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Отзыв:</b>
                            {!! Form::textarea('text', null, ['id' => 'text', 'class' => 'form-control maxlength', 'maxlength' => 1000, 'rows' => 2]) !!}
                            <span class="help-block error text_error text-danger font-12" style="display: none">
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

    // Change position
    var reviewsSortableOptions = {
        cursor: 'move',
        axis: 'y',
        update: function (event, ui) {
            var positions = $(this).sortable('toArray');
            $.ajax({
                data: {positions: positions},
                type: 'POST',
                url: '{{ route('admin.reviews.position') }}',
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
    $(".sortable-reviews").sortable(reviewsSortableOptions);

    // Init plugins after ajax
    function initPluginsAfterAjaxReviews() {
        $(".sortable-reviews").sortable(reviewsSortableOptions);
        initDropifyAjax();
        $('.editable-text').editable(getSettingsEditableOptions());
        $('#reviews .reviews-items').find('[data-plugin="switchery"]').each(function (i, o) {
            new Switchery($(this)[0], $(this).data())
        })
        $('[data-toggle="tooltip"]').tooltip();

        // init tooltips, switchery
//        $.Components.init();
    };

    // Delete item
    $('#reviews').on('click', '.delete-item', function(e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var itemId = $(this).data('itemId');

        swal({
            title: "Удалить отзыв?",
            text: 'Вы точно хотите удалить безвозвратно этот отзыв?',
            type: "error",
            showCancelButton: true,
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Удалить'
        }).then(function() {
            $.ajax({
                data: {},
                type: 'DELETE',
                url: "/admin/reviews/" + itemId,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success) {
                        notification(response.message, 'success');

                        $('#reviews .reviews-items').html(response.resultHtml);

                        initPluginsAfterAjaxReviews();
                    } else {
                        notification(response.message, 'error');
                    }
                },
            });
        }, function(dismiss) {});
    });

    // Add new review: open form for added new item
    $('#reviews').on('click', '.open-review-form', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var $form = $('.new-review-form');
        if($form.is(':visible')) {
            $form.hide();
        } else {
            $form.show();
            $('html, body').animate({
                scrollTop: $('.new-review-form').offset().top - 120
            }, 1000);
        }
    });

    var dropify = $('.dropify').dropify(dropifyOptions);

    // Add new review: add new item
    $('#new-review-form').on('submit', function (e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var $form = $(this),
            formData = new FormData(),
            params   = $form.serializeArray(),
            image    = $form.find('[name="user_avatar"]')[0].files[0],
            url = $form.attr('action');

        $.each(params, function(i, val) {
            formData.append(val.name, val.value);
        });
        if(image) {
            formData.append('user_avatar', image);
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

                    $('#reviews .reviews-items').html(response.resultHtml);
                    $('.new-review-form').hide();
                    $('html, body').animate({
                        scrollTop: $('.reviews-item[id="' + response.itemId + '"]').offset().top - 100
                    }, 1000);

                    $form.trigger('reset');
                    var drEvent = $form.find('.dropify').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    var dropify = $('.dropify').dropify(dropifyOptions);

                    initPluginsAfterAjaxReviews();
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