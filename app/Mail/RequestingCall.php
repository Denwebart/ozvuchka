<?php
/**
 * Class RequestingCall
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Mail;

use App\Models\RequestedCall;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestingCall extends Mailable
{
	use Queueable, SerializesModels;
	
	// Call data.
	protected $call;
	
	/**
	 * LetterFromContactformToUser constructor. Create a new message instance.
	 *
	 * @param RequestedCall $call
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function __construct(RequestedCall $call)
	{
		$this->call = $call;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject('Заказан звонок! (с сайта ' . \Config::get('settings.domain') . ')')
			->markdown('emails.requestedCall.toAdmin')->with([
				'call' => $this->call,
			]);
	}
}