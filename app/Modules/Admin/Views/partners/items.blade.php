<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($partners))
    <div class="sortable sortable-partners">
        @foreach($partners as $item)
            <div class="row item partners-item" id="{{ $item->id }}" data-item-id="{{ $item->id }}">
                <div class="thumbnail p-0 m-b-0">
                    <div class="col-sm-4 p-t-b-10">
                        {!! Form::file('image', ['id' => 'image-' . $item->id, 'class' => 'dropify-ajax', 'data-default-file' => $item->getImageUrl(), 'data-height' => '120px', 'data-max-file-size' => '3M', 'data-min-width' => '339', 'data-min-height' => '339', 'data-item-id' => $item->id, 'data-delete-url' => route('admin.partners.deleteImage'), 'data-upload-url' => route('admin.partners.uploadImage')]) !!}
                    </div>
                    <div class="col-sm-6 p-t-b-10">
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Заголовок:</b>
                            <a href="#" class="editable-text" data-value="{{ $item->title }}" data-name="title" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->title }}</a>
                        </p>
                        <p>
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">
                                Альт:
                                <!-- Info text: image_alt -->
                                <span class="m-l-10 text-muted help-popover" data-container="body" title="" data-toggle="popover" data-trigger="hover" data-placement="right" tabindex="0" data-content="ALT - это краткое и правдивое описание изображения. Обязательно должен содержать важные ключевые фразы для продвижения изображения (не страницы). Рекомендуемая длина не менее 3-4 слов и не более 255 символов. Поисковики учитывают не весь ALT, а лишь несколько первых слов. Для Google лимит 16 слов, для Яндекса – 28 слов." data-original-title="Атрибут ALT для изображения">
                                    <i class="fa fa-question-circle-o"></i>
                                </span>
                            </b>
                            <a href="#" class="editable-text" data-value="{{ $item->image_alt }}" data-name="image_alt" data-type="textarea" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->image_alt }}</a>
                        </p>
                        <p class="m-b-20">
                            <b class="font-13 text-muted" style="width: 75px; display: inline-block">Описание:</b>
                            <a href="#" class="editable-text" data-value="{{ $item->description }}" data-name="description" data-type="textarea" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->description }}</a>
                        </p>
                        <div class="social-links social-links-partners-{{ $item->id }}">
                            <h4 class="header-title open-social-links-form" data-id="{{ $item->id }}">
                                <a href="#" class="m-r-10 text-muted">Социальные сети</a>
                                <a href="{{ $item->link_vk }}" target="_blank" rel="nofollow noopener" class="button-link_vk btn btn-vk waves-effect waves-light" @if(!$item->link_vk) style="display: none" @endif>
                                    <i class="fa fa-vk"></i>
                                </a>
                                <a href="{{ $item->link_facebook }}" target="_blank" rel="nofollow noopener" class="button-link_facebook btn btn-facebook waves-effect waves-light" @if(!$item->link_facebook) style="display: none" @endif>
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="{{ $item->link_instagram }}" target="_blank" rel="nofollow noopener" class="button-link_instagram btn btn-instagram waves-effect waves-light" @if(!$item->link_instagram) style="display: none" @endif>
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="{{ $item->link_twitter }}" target="_blank" rel="nofollow noopener" class="button-link_twitter btn btn-twitter waves-effect waves-light" @if(!$item->link_twitter) style="display: none" @endif>
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="{{ $item->link_google }}" target="_blank" rel="nofollow noopener" class="button-link_googleplus btn btn-googleplus waves-effect waves-light" @if(!$item->link_google) style="display: none" @endif>
                                    <i class="fa fa-google-plus"></i>
                                </a>
                                <a href="{{ $item->link_youtube }}" target="_blank" rel="nofollow noopener" class="button-link_youtube btn btn-youtube waves-effect waves-light" @if(!$item->link_youtube) style="display: none" @endif>
                                    <i class="fa fa-youtube"></i>
                                </a>
                                <a href="#" title="Добавить" data-toggle="tooltip">
                                    <i class="fa fa-plus m-l-10"></i>
                                </a>
                            </h4>
                            <div class="social-links-form-{{ $item->id }}" style="display: none">
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">VK:</b>
                                    <a href="#" class="editable-text" data-value="{{ $item->link_vk }}" data-name="link_vk" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->link_vk }}</a>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Facebook:</b>
                                    <a href="#" class="editable-text" data-value="{{ $item->link_facebook }}" data-name="link_facebook" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->link_facebook }}</a>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Instagram:</b>
                                    <a href="#" class="editable-text" data-value="{{ $item->link_instagram }}" data-name="link_instagram" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->link_instagram }}</a>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Twitter:</b>
                                    <a href="#" class="editable-text" data-value="{{ $item->link_twitter }}" data-name="link_twitter" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->link_twitter }}</a>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">Google:</b>
                                    <a href="#" class="editable-text" data-value="{{ $item->link_google }}" data-name="link_google" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->link_google }}</a>
                                </p>
                                <p>
                                    <b class="font-13 text-muted" style="width: 75px; display: inline-block">YouTube:</b>
                                    <a href="#" class="editable-text" data-value="{{ $item->link_youtube }}" data-name="link_youtube" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.partners.setValue') }}">{{ $item->link_youtube }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="switchery-demo m-t-10 text-right">
                            {!! Form::hidden('is_published', 0) !!}
                            {!! Form::checkbox('is_published', 1, $item->is_published, ['id' => 'is_published-' . $item->id, 'data-plugin' => 'switchery', 'class' => 'ajax-checkbox', 'data-url' => route('admin.partners.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $item->id]) !!}
                        </div>
                        <div class="buttons pull-right m-t-20 m-r-5">
                            <a href="#" class="delete-item" data-item-id="{{ $item->id }}" data-item-title="{{ $item->title }}" title="Удалить отзыв" data-toggle="tooltip">
                                <i class="mdi mdi-close"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="background-icon text-center p-t-b-20">
        <p>Партнеров нет</p>
        <a href="#" class="open-partner-form">
            <i class="fa fa-handshake-o"></i>
        </a>
    </div>
@endif