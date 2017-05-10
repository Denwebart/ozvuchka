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

class ActivateAccount extends Mailable
{
	use Queueable, SerializesModels;
	
	// User data.
	protected $user;
	// Redirect path after activation.
	protected $redirectPath;
	
	/**
	 * Create a new message instance.
	 *
	 * @param \App\Models\User $user
	 */
	public function __construct(User $user, $redirectPath)
	{
		$this->user = $user;
		$this->redirectPath = $redirectPath;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		// Create activation link.
		$activationLink = route('activation', [
			'id' => $this->user->id,
			'token' => md5($this->user->email),
			'redirect' => urlencode($this->redirectPath),
		]);
		
		return $this->subject(trans('auth.activateAccountSubject'))
			->markdown('emails.account.activate')->with([
				'activationLink' => $activationLink,
			]);
	}
}