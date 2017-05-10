<?php
/**
 * Class Translit
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

class Translit
{
	protected static $translitArray = [
		'ый' => 'y',
		'ье' => 'ye',
		
		'а'=>'a',
		'б'=>'b',
		'в'=>'v',
		'г'=>'g',
		'д'=>'d',
		'е'=>'e',
		'ё'=>'e',
		'ж'=>'zh',
		'з'=>'z',
		'и'=>'i',
		'й'=>'j',
		'к'=>'k',
		'л'=>'l',
		'м'=>'m',
		'н'=>'n',
		'о'=>'o',
		'п'=>'p',
		'р'=>'r',
		'с'=>'s',
		'т'=>'t',
		'у'=>'u',
		'ф'=>'f',
		'х'=>'h',
		'ц'=>'ts',
		'ч'=>'ch',
		'ш'=>'sh',
		'щ'=>'shch',
		'ъ'=>'',
		'ы'=>'y',
		'ь'=>'',
		'э'=>'e',
		'ю'=>'yu',
		'я'=>'ya',
		'і' => 'i',
		'ї' => 'i',
		'є' => 'e',
		'ґ' => 'g',
		' '=>'-',
		'_' => '-',
	];
	
	/**
	 * @param $title
	 * @param $alias
	 * @param bool $rewrite
	 * @return bool
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function generateAlias($title, $alias, $rewrite = false)
	{
		if(!$rewrite) {
			// don't rewrite alias
			if(!$alias) {
				return self::make($title);
			}
			return $alias;
		} else {
			// rewrite alias
			return self::make($title);
		}
	}
	
	/**
	 * Generate filename on latin transcription
	 *
	 * @param $fileName
	 * @return mixed|string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function generateFileName($fileName)
	{
		return self::make($fileName, '/[^a-zа-яёіїєґ0-9-._ ]+/iu');
	}
	
	/**
	 * Transliteration
	 *
	 * @param $string
	 * @param string $pattern
	 * @return mixed|string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function make($string, $pattern = '/[^a-zа-яёіїєґ0-9-_ ]+/iu')
	{
		$text = preg_replace(
			$pattern,
			'',
			preg_replace('/\s+/', ' ', trim(strip_tags(html_entity_decode(mb_strtolower($string)))))
		);
		foreach(self::$translitArray as $from => $to) {
			$text = mb_eregi_replace($from, $to, $text);
		}
		return $text;
	}
}