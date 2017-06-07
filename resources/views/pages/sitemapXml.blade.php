<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="' . asset('sitemap.xsl') . '"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($sitemapItems as $item)
        @include('parts.sitemapXmlItem')

        {{ \App\Helpers\View::getChildrenPages($item, $item->getUrl(), 1, 'xml') }}
    @endforeach

    <image>
        <url>{{ url('images/logo.png') }}</url>
        @if(isset($siteSettings['siteTitle']) && is_object($siteSettings['siteTitle']))
            <title>
                {{ $siteSettings['siteTitle']->value }}
            </title>
        @endif
        @if(isset($siteSettings['siteSlogan']) && is_object($siteSettings['siteSlogan']))
            <slogan>
                {{ $siteSettings['siteSlogan']->value }}
            </slogan>
        @endif
        <siteurl>{{ Config::get('settings.domain') }}</siteurl>
        <copyright>
            @if(Config::get('settings.startupYear') != date('Y'))
                {{ Config::get('settings.startupYear') }} -
            @endif
            {{ date('Y') }} ©
        </copyright>
    </image>
</urlset>