<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<section class="section requesting-call border-top border-bottom">
    <div class="container">
        @if($title || $description)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="voffset50"></div>
                    @if($description)
                        <p class="pretitle">{{ $description }}</p>
                    @endif
                    @if($title)
                        <div class="voffset20"></div>
                        <h2 class="title">{{ $title }}</h2>
                    @endif
                </div>
            </div>
        @endif
        <!-- gallery -->
        <div class="voffset50"></div>
        <div class="row">
            {!! Form::open(['route' => ['call.request'], 'class' => 'ajax-form', 'id' => 'request-call-form']) !!}

                <div class="response-message success" role="alert" @if(!Session::has('successMessage')) style="display: none" @endif>
                    @if(Session::has('successMessage'))
                        {{ Session::get('successMessage') }}
                    @endif
                </div>
                <div class="response-message error" role="alert" @if(!Session::has('errorMessage')) style="display: none" @endif>
                    @if(Session::has('errorMessage'))
                        {{ Session::get('errorMessage') }}
                    @endif
                </div>

                <div class="form-fields">
                    <div class="full-xxs col-xs-6 col-sm-4 col-sm-offset-2">
                        <div class="form-group @if($errors->has('name')) has-error @endif" title="Имя *">
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Имя *']) !!}
                            {{--Errors--}}
                            <span class="help-block error name_error" @if(!$errors->has('name')) style="display: none;" @endif>
                                <span class="text">{{ $errors->first('name') }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="full-xxs col-xs-6 col-sm-4">
                        <div class="form-group @if($errors->has('phone')) has-error @endif" title="phone *">
                            {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Телефон *']) !!}
                            {{--Errors--}}
                            <span class="help-block error phone_error" @if(!$errors->has('phone')) style="display: none;" @endif>
                                <span class="text">{{ $errors->first('phone') }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <p class="loadmore">
                            <button type="submit" class="btn rounded border btn-dark">
                                Перезвоните мне
                            </button>
                        </p>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="voffset80"></div>
    </div>
</section>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.ajax-form').on('submit', function (e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var $form = $(this),
                formData = new FormData(),
                params   = $form.serializeArray(),
                url = $form.attr('action');

            if($form.find('[type="file"]').length) {
                var image = $form.find('[type="file"]')[0].files[0]
            }

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
                    $form.find('.error').hide().find('.text').text('');
                    $form.find('.has-error').removeClass('has-error');
                    $form.find('.response-message').hide().text('');
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success) {
//                        notification(response.message, 'success');

                        $form.trigger('reset');

                        $form.find('.response-message.success').show().text(response.message);
                        $form.find('.form-fields').hide();

                        $('html, body').animate({
                            scrollTop: $(this).offset().top - 50
                        }, 1000);
                    } else {
//                        notification(response.message, 'error');

                        $form.find('.response-message.error').show().text(response.message);

                        $.each(response.errors, function(index, value) {
                            var errorDiv = '.' + index + '_error';
                            $form.find(errorDiv).parent().addClass('has-error');
                            $form.find(errorDiv).show().find('.text').text(value);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush