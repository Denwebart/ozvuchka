<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(isset($siteSettings['socialLinks']) && is_array($siteSettings['socialLinks']))
    <div class="title small">Мы в социальных сетях</div>
    <ul class="social">
        @foreach($siteSettings['socialLinks'] as $socialLinkKey => $socialLink)
            @if(is_object($socialLink))
                <li class="{{ $socialLinkKey }}">
                    <a href="{{ $socialLink->value }}" target="_blank" rel="nofollow noopener" title="{{ $socialLink->title }}">
                        <i class="fa fa-{{ $socialLinkKey }}"></i>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
@endif