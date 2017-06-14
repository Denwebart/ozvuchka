<?php
/**
 * Contact Page View
 *      (PagesController@getContactPage)
 *
 * Variables:
 *      $page - object App\Models\Page
 *
 * Sending letter from contact form (to database, to admins, to user).
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.app')

@section('content')
    <!-- INTRO -->
    <section class="intro intro-mini full-width jIntro bg-blog" style="background-image: url({{ asset('frontend/images/backgrounds/contacts.jpg') }})" id="anchor00">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="primary-title">{{ $page->getTitle() }}</h1>
                        {{--<h2 class="subtitle-text"></h2>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PAGE TITLE AND INTROTEXT -->
    @if($page->title || $page->introtext)
        <section class="section featured-shop">
            <div class="container">
                @if($page->title)
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="voffset50"></div>
                            <h2 class="title">{{ $page->title }}</h2>
                            <div class="voffset50"></div>
                        </div>
                    </div>
                @endif
                @if($page->introtext)
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="page-content">
                                {!! $page->introtext !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- CONTACTS -->
    <section class="section inverse-color contact" id="anchor08">
        <div class="container">
            <div class="voffset50"></div>
            <div class="row">
                <div class="col-sm-6 col-md-7">

                    <p class="pretitle">Если возникли вопросы или есть пожелания</p>
                    <div class="voffset20"></div>
                    <h2 class="title">Свяжитесь с нами</h2>
                    <div class="voffset20"></div>

                    {!! Form::open(['route' => ['contact.sendLetter'], 'class' => 'ajax-form contact-form', 'id' => 'contact-form']) !!}

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

                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        <label class="title small" for="name">Имя:</label>
                        {!! Form::text('name', null, ['id' => 'name', 'class' => 'text name', 'placeholder' => 'Ваше имя *']) !!}
                        {{--Errors--}}
                        <span class="help-block error name_error" @if(!$errors->has('name')) style="display: none;" @endif>
                            <span class="text">{{ $errors->first('name') }}</span>
                        </span>
                    </div>

                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label class="title small" for="name">Email:</label>
                        {!! Form::text('email', null, ['id' => 'email', 'class' => 'text email', 'placeholder' => 'Ваш Email *']) !!}
                        {{--Errors--}}
                        <span class="help-block error email_error" @if(!$errors->has('email')) style="display: none;" @endif>
                            <span class="text">{{ $errors->first('email') }}</span>
                        </span>
                    </div>
                    <div class="form-group @if($errors->has('subject')) has-error @endif">
                        <label class="title small" for="message">Тема:</label>
                        {!! Form::text('subject', null, ['id' => 'subject', 'class' => 'text', 'placeholder' => 'Тема письма']) !!}
                        {{--Errors--}}
                        <span class="help-block error subject_error" @if(!$errors->has('subject')) style="display: none;" @endif>
                            <span class="text">{{ $errors->first('subject') }}</span>
                        </span>
                    </div>
                    <div class="form-group @if($errors->has('message')) has-error @endif">
                        <label class="title small" for="message">Сообщение:</label>
                        {!! Form::textarea('message', null, ['id' => 'message', 'class' => 'text area', 'placeholder' => 'Ваш вопрос или пожелание *', 'rows' => 3]) !!}
                        {{--Errors--}}
                        <span class="help-block error message_error" @if(!$errors->has('message')) style="display: none;" @endif>
                            <span class="text">{{ $errors->first('message') }}</span>
                        </span>
                    </div>
                    {!! Form::hidden('send_copy', 0) !!}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::hidden('send_copy', 0) !!}--}}
                        {{--{!! Form::checkbox('send_copy', 1, 1, ['id' => 'send_copy', 'class' => 'float-left']) !!}--}}
                        {{--{!! Form::label('send_copy', 'Отправить копию этого сообщения на Ваш адрес e-mail', ['class' => 'control-label float-left']) !!}--}}
                    {{--</div>--}}

                    <!--<div class="formSent"><p><strong>Ваше сообщение было отправлено!</strong> Спасибо, что связались с нами.</p></div>-->
                    <input type="submit" value="Отправить" class="btn rounded">
                    <div class="voffset80"></div>

                    {!! Form::close() !!}
                </div>
                <div class="col-sm-6 col-md-5">
                    <div class="col-contact">
                        <h4 class="title small">Роман Ракитянский ( Romankin )</h4>
                        <p>Должность</p>
                        <ul class="contact">
                            <li><i class="fa fa-phone"></i> +38 (067) 737-99-17</li>
                            <li><i class="fa fa-phone"></i> +38 (063) 230-37-97</li>
                            <li><i class="fa fa-phone"></i> +38 (057) 750-98-48</li>
                            <li><i class="fa fa-envelope"></i> romankin@mail.ru</li>
                            <li><i class="fa fa-skype"></i> djromankin</li>
                            <li><i class="fa fa-icq"></i> 58-2959-148</li>
                            <li><i class="fa fa-vk"></i><a href="http://vk.com/djromankin">http://vk.com/djromankin</a></li>
                        </ul>

                        <h4 class="title small">Сергей Долгих</h4>
                        <div class="voffset20"></div>
                        <ul class="contact">
                            <li><i class="fa fa-phone"></i> +38 (067) 732-46-14</li>
                            <li><i class="fa fa-phone"></i> +38 (095) 007-26-89</li>
                            <li><i class="fa fa-phone"></i> +38 (093) 074-24-25</li>
                        </ul>

                        @if(isset($siteSettings['socialLinks']) && is_array($siteSettings['socialLinks']))
                            <h4 class="title small">Мы в социальных сетях</h4>
                            <ul class="social-links">
                                @foreach($siteSettings['socialLinks'] as $socialLinkKey => $socialLink)
                                    @if(is_object($socialLink))
                                        <li>
                                            <a href="{{ $socialLink->value }}" target="_blank" rel="nofollow noopener" title="{{ $socialLink->title }}">
                                                <i class="fa fa-{{ $socialLinkKey }}"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="voffset50"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    @if($page->content)
        <section class="section featured-shop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
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