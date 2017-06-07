<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! Form::open(['route' => ['call.request'], 'class' => 'ajax-form', 'id' => 'request-call-form']) !!}

<div class="response-message success alert alert-success" role="alert" @if(!Session::has('successMessage')) style="display: none" @endif>
    @if(Session::has('successMessage'))
        {{ Session::get('successMessage') }}
    @endif
</div>

<div class="response-message error alert alert-danger" role="alert" @if(!Session::has('errorMessage')) style="display: none" @endif>
    @if(Session::has('errorMessage'))
        {{ Session::get('errorMessage') }}
    @endif
</div>

<h3>Заказать звонок</h3>
<div class="small-description">
    Закажите звонок, и менеджер перезвонит вам
    в течение рабочего дня call-центра.
</div>

<div class="form-group @if($errors->has('name')) has-error @endif" title="Имя *">
    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Имя *']) !!}
    {{--Errors--}}
    <span class="help-block error name_error" @if(!$errors->has('name')) style="display: none;" @endif>
        <span class="text">{{ $errors->first('name') }}</span>
    </span>
</div>
<div class="form-group @if($errors->has('phone')) has-error @endif" title="phone *">
    {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Телефон *']) !!}
    {{--Errors--}}
    <span class="help-block error phone_error" @if(!$errors->has('phone')) style="display: none;" @endif>
        <span class="text">{{ $errors->first('phone') }}</span>
    </span>
</div>
<button class="btn btn-default" type="submit">Перезвоните мне</button>
{!! Form::close() !!}

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