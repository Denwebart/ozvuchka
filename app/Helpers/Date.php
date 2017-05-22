<?php
/**
 * Class Date
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

use Carbon\Carbon;

class Date
{
	protected static $months = [
		'1' => 'января',
		'2' => 'февраля',
		'3' => 'марта',
		'4' => 'апреля',
		'5' => 'мая',
		'6' => 'июня',
		'7' => 'июля',
		'8' => 'августа',
		'9' => 'сентября',
		'10' => 'октября',
		'11' => 'ноября',
		'12' => 'декабря',
	];

	protected static $shortMonths = [
		'1' => 'янв.',
		'2' => 'февр.',
		'3' => 'марта',
		'4' => 'апр.',
		'5' => 'мая',
		'6' => 'июня',
		'7' => 'июля',
		'8' => 'авг.',
		'9' => 'сент.',
		'10' => 'окт.',
		'11' => 'нояб.',
		'12' => 'дек.',
	];

	/**
	 * Global date format
	 *
	 * @param string $date
	 * @param bool $withTime
	 * @param bool $isShortMonth
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function format($date, $withTime = false, $withYear = false, $isShortMonth = false)
	{
		if(!is_null($date)) {
			$timestamp = strtotime($date);
			$month = ($isShortMonth) ?
				self::$shortMonths[date('n', $timestamp)] : self::$months[date('n', $timestamp)];
			$time = ($withTime) ? " в H:i" : "";
			if($withYear) {
				$year = ' ' . date('Y', $timestamp);
			} else {
				$year = date('Y', $timestamp) != date('Y')
					? ' ' . date('Y', $timestamp)
					: '';
			}
			return date("j $month" . $year . $time, $timestamp);
		} else {
			return '-';
		}
	}
	
	/**
	 * Make date format
	 *
	 * @param string $date
	 * @param string $format
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function make($date, $format)
	{
		if(!is_null($date)) {
			$timestamp = strtotime($date);
			$patterns = ['/F/', '/M/'];
			$replacements = [
				self::$months[date('n', $timestamp)],
				self::$shortMonths[date('n', $timestamp)]
			];
			$format = preg_replace($patterns, $replacements, $format);
			return date($format, $timestamp);
		} else {
			return '-';
		}
	}

	/**
	 * Date format: "1 min. ago" etc.
	 *
	 *     ? < 10 sec            - "just now"
	 *     10 sec. < ? < 1 min   - "n sec. ago"
	 *     1 min. < ? < 1 hours  - "n min. ago"
	 *     1 hours < ? < 3 hours - "(1, 2, 3) hours ago"
	 *     3 hours < ? and today - today at nn:nn
	 *     tomorrow              - tomorrow at nn:nn
	 *     else                  - date time
	 *
	 * @param string $date
	 * @param bool $withTime default false
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getRelative($date, $withTime = true)
	{
		if(!is_null($date)) {
			$timestamp = strtotime($date);
			
			$timeDifference = (time() - $timestamp);
			
			if($timeDifference < 10) {
				$result = 'только что';
			} elseif ($timeDifference < 60) {
				$result = round($timeDifference, 0) . ' сек. назад';
			} elseif ($timeDifference < (60 * 60)) {
				$result = round(($timeDifference / 60), 0) . ' мин. назад';
			} elseif ($timeDifference <= (60 * 60 * 3.1)) {
				$result = round(($timeDifference / (60 * 60)), 0) . ' ч. назад';
			}
			elseif (Carbon::today()->timestamp == strtotime(date('d-m-Y', $timestamp))) {
				$result = 'сегодня в ' . date('H:i', $timestamp);
			} elseif (Carbon::yesterday()->timestamp == strtotime(date('d-m-Y', $timestamp))) {
				$result = 'вчера в ' . date('H:i', $timestamp);
			} else {
				$result = self::format($date, $withTime);
			}
			
			return $result;
		}
		else return '-';
	}

	/**
	 * Date format for Schema.org (example: 2015-01-26T16:55:03Z)
	 *
	 * @param string $date
	 * @param bool $withTime
	 * @return string
	 */
	public static function dateFormatForSchema($date, $withTime = true)
	{
		if(!is_null($date)) {
			$timestamp = strtotime($date);
			$time = ($withTime) ? '\T' . "H:i": "";
			return date("Y-m-d" . $time, $timestamp);
		}
	}
}