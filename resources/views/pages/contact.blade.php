<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <h1>{{ $page->title }}</h1>

    <h3>Связаться с администрацией сайта</h3>
    <div class="small-description">
        Если у Вас возникли вопросы или есть
        предложения - напишите нам, и мы постараемся
        ответить как можно быстрее.
    </div>

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

    {!! Form::open(['route' => ['contact.sendLetter'], 'class' => 'ajax-form form-horizontal', 'id' => 'contact-form']) !!}
        <div class="form-group @if($errors->has('name')) has-error @endif" title="Имя *">
            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Имя *']) !!}
            {{--Errors--}}
            <span class="error help-block name_error" @if(!$errors->has('name')) style="display: none;" @endif>
                <span class="text">{{ $errors->first('name') }}</span>
            </span>
        </div>
        <div class="form-group @if($errors->has('email')) has-error @endif" title="Email *">
            {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email *']) !!}
            {{--Errors--}}
            <span class="error help-block email_error" @if(!$errors->has('email')) style="display: none;" @endif>
                <span class="text">{{ $errors->first('email') }}</span>
            </span>
        </div>
        <div class="form-group @if($errors->has('subject')) has-error @endif" title="Тема письма">
            {!! Form::text('subject', null, ['id' => 'subject', 'class' => 'form-control', 'placeholder' => 'Тема письма']) !!}
            {{--Errors--}}
            <span class="error help-block subject_error" @if(!$errors->has('subject')) style="display: none;" @endif>
                <span class="text">{{ $errors->first('subject') }}</span>
            </span>
        </div>
        <div class="form-group @if($errors->has('message')) has-error @endif" title="Текст письма *">
            {!! Form::textarea('message', null, ['id' => 'message', 'class' => 'form-control', 'placeholder' => 'Текст письма *', 'rows' => 5]) !!}
            {{--Errors--}}
            <span class="error help-block message_error" @if(!$errors->has('message')) style="display: none;" @endif>
                <span class="text">{{ $errors->first('message') }}</span>
            </span>
        </div>
        <div class="form-group">
            {!! Form::hidden('send_copy', 0) !!}
            {!! Form::checkbox('send_copy', 1, 1, ['id' => 'send_copy', 'class' => 'float-left']) !!}
            {!! Form::label('send_copy', 'Отправить копию этого сообщения на Ваш адрес e-mail', ['class' => 'control-label float-left']) !!}
        </div>
        <button class="btn btn-default" type="submit">Отправить</button>
    {!! Form::close() !!}
@endsection()

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
                    $('.response-message').hide().text('');
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success) {
//                        notification(response.message, 'success');

                        $form.trigger('reset');

                        $('.response-message.success').show().text(response.message);

                        $('html, body').animate({
                            scrollTop: $(this).offset().top - 50
                        }, 1000);
                    } else {
//                        notification(response.message, 'error');

                        $('.response-message.error').show().text(response.message);

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