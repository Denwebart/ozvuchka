<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

class Str
{
	/**
	 * Обрезка фрагмента текста до пробела с учетом кодировки
	 *
	 * @param $html
	 * @param $size
	 * @param $end
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function limit($html, $size, $end = '...')
	{
		if(mb_strlen($html) > $size) {
			$string = strip_tags($html);
			return mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $size,'utf-8'),' ', 'utf-8'),'utf-8') . $end;
		} else {
			return strip_tags($html);
		}
	}
	
	/**
	 * Closing html tags which not closed
	 *
	 * @param $html
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function closeTags($html)
	{
		preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
		$openedtags = $result[1];
		preg_match_all('#</([a-z]+)>#iU', $html, $result);
		$closedtags = $result[1];
		$len_opened = count($openedtags);
		if (count($closedtags) == $len_opened) {
			return $html;
		}
		$openedtags = array_reverse($openedtags);
		for ($i=0; $i < $len_opened; $i++) {
			if (!in_array($openedtags[$i], $closedtags)) {
				$html .= '</'.$openedtags[$i].'>';
			} else {
				unset($closedtags[array_search($openedtags[$i], $closedtags)]);
			}
		}
		return $html;
	}

	/**
	 * Adding attribute rel=nofollow to the links
	 *
	 * @param string $html
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function nofollowLinks($html)
	{
		$html = preg_replace("~<a.*?</a>(*SKIP)(*F)|<img.*?>(*SKIP)(*F)|(http|https|ftp|ftps)://([^\s\[<]+)~i", '<a href="$1://$2">$1://$2</a>', $html);
		return preg_replace_callback('/<a(.*?)href="(.*?)"(.*?)>/', [new StringHelper(), 'checkLinksAndReplace'], $html);
	}

	/**
	 * Checking links for adding attribute
	 * rel="nofollow noopener" and target="_blank" if link is referal
	 *
	 * @param $link
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function checkLinksAndReplace($link)
	{
		if($link[2][0] == '/' || (strpos($link[2], env('APP_URL', 'http://localhost')) !== false)) {
			return '<a' . $link[1] . 'href="' . $link[2] . '" '. $link[3] .'>';
		}
		else {
			if (!preg_match("~^(?:f|ht)tps?://~i", $link[2])) {
				$link[2] = "http://" . $link[2];
			}
			return '<a' . $link[1] . 'href="' . $link[2] . '" rel="nofollow noopener" target="_blank">';
		}
	}

	/**
	 * Searching text fragment with concrete word and marking it
	 *
	 * @param string $text
	 * @param string $word
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getFragment($text, $word)
	{
		if ($word) {
			$pos = max(mb_stripos(strip_tags($text), $word, null, 'UTF-8') - 100, 0);
			$fragment = mb_substr(strip_tags($text), $pos, 200, 'UTF-8');
			$highlighted = preg_replace("[(".quotemeta($word).")]iu", '<mark>$1</mark>', $fragment);
		} else {
			$highlighted = mb_substr(strip_tags($text), 0, 200, 'UTF-8');
		}
		return $highlighted;
	}

	/**
	 * Формат номера телефона
	 *
	 * @param $phone
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function phoneFormat($phone)
	{
		$number = preg_replace("/[^0-9]/", "", $phone);
		if($number) {
			$phone = substr_replace($number, '-', -2, -2);
			$phone = substr_replace($phone, '-', -5, -5);
			$phone = substr_replace($phone, ') ', -9, -9);
			$phone = substr_replace($phone, ' (', -14, -14);

			if($number[0] == 3 || $number[0] == 7) {
				$phone = substr_replace($phone, '+', 0, 0);
			}
		} else {
			$phone = '-';
		}

		return $phone;
	}

	/**
	 * Формат цены
	 *
	 * @param $price
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function priceFormat($price)
	{
		$currency = \Request::cookie('currency', \Config::get('checkout.defaultCurrency.code'));
		$course = \Cache::get('course' . $currency);
		if($currency == 'USD' && $course) {
			$price = $price / $course;
		}
		$afterPoint = ($currency == 'USD') ? 2 : 0;
		if($currency == 'USD' && $course) {
			$currency = ' $';
		} elseif($currency == 'RUB' && $course) {
			$currency = ' руб.';
		} elseif($currency == 'UAH' && $course) {
			$currency = ' грн.';
		} else {
			$currency = ' ' . \Config::get('checkout.defaultCurrency.text');
		}
		return number_format($price, $afterPoint, '.', ' ') . $currency;
	}
	
	/**
	 * Удаление ссылок из текста
	 *
	 * @param $html
	 * @return mixed
	 */
	public static function withoutLinks($html)
	{
		return str_replace('</a>', '', preg_replace('/<a\b[^>]*+>|<\/a\b[^>]*+>/', '', $html));
	}
	
	/**
	 * Get first image from html
	 *
	 * @param $html
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getImageFromHtml($html)
	{
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $html, $image);
		return isset($image['src']) ? $image['src'] : '';
	}
	
	/**
	 * Склонение слова "товар" в зависимости от количества
	 * @param integer $productsCount
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
    public static function wordProductCount($productsCount)
    {
	    if($productsCount%10 == 1 && $productsCount != 11) {
		    $string = 'товар';
	    } elseif (in_array($productsCount%10, [2, 3, 4])) {
		    $string = 'товара';
	    } else {
		    $string = 'товаров';
	    }

	    return $productsCount . ' ' . $string;
    }
	/**
	 * Склонение слова "значение" в зависимости от количества
	 * @param integer $valuesCount
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function wordValuesCount($valuesCount)
	{
		if($valuesCount%10 == 1 && $valuesCount != 11) {
			$string = 'значение';
		} elseif (in_array($valuesCount%10, [2, 3, 4])) {
			$string = 'значения';
		} else {
			$string = 'значений';
		}

		return $valuesCount . ' ' . $string;
	}
	
	/**
	 * Number format.
	 *
	 * @param $value
	 * @param int $afterPoint
	 * @return string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function numberFormat($value, $afterPoint = 0)
	{
		return number_format($value, $afterPoint, '.', ' ');
	}
}