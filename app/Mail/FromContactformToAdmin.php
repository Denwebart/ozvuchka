<?php
/**
 * Class FromContactformToAdmin
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Mail;

use App\Models\Letter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FromContactformToAdmin extends Mailable
{
	use Queueable, SerializesModels;
	
	// Letter data.
	protected $letter;
	
	/**
	 * LetterFromContactformToUser constructor. Create a new message instance.
	 *
	 * @param Letter $letter
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function __construct(Letter $letter)
	{
		$this->letter = $letter;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject('Письмо с сайта' . \Config::get('settings.domain'))
			->markdown('emails.fromContactform.toAdmin')->with([
				'letter' => $this->letter,
			]);
	}
}