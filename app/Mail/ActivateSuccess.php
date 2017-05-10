<?php
/**
 * Class ActivateAccount
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateSuccess extends Mailable
{
	use Queueable, SerializesModels;
	
	// User data.
	protected $user;
	
	/**
	 * Create a new message instance.
	 *
	 * @param \App\Models\User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject(trans('auth.activateSuccessSubject'))
			->markdown('emails.account.activateSuccess')->with([
				'user' => $this->user
			]);
	}
}