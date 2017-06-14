<?php
/**
 * Class RequestedCalls
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\RequestedCalls;

use App\Models\RequestedCall;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class RequestedCalls extends BaseController
{
	public $title = 'Заказать звонок';
	public $description = 'Закажите звонок, и мы свяжемся с вами в ближайше время.';
	
	public function show()
	{
		return view('widget.requestedCalls::index')
			->with('title', $this->title)->with('description', $this->description)->render();
	}
	
	/**
	 * Requesting call
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function create(Request $request)
	{
		$data = $request->all();
		$validator = \Validator::make($data, RequestedCall::$rules);
		
		if($validator->fails()) {
			if($request->ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Укажите имя и телефон, чтобы мы могли Вам дозвониться.',
					'errors' => $validator->errors()
				]);
			} else {
				return back()->withErrors($validator->errors())->withInput()
					->with('errorMessage', 'Укажите имя и телефон, чтобы мы могли Вам дозвониться.');
			}
		}
		
		if($call = RequestedCall::create($data)) {

//			Notification::forAllUsers(Notification::TYPE_NEW_LETTER, [
//				'[linkToLetter]' => route('admin.letters.show', ['id' => $letter->id]),
//				'[letterFromEmail]' => $letter->email,
//				'[letterFromName]' => $letter->name,
//				'[letterSubject]' => $letter->subject,
//				'[letterText]' => $letter->message,
//				'[letterCreatedAt]' => $letter->created_at,
//			]);
			
			if($request->ajax()) {
				return \Response::json([
					'success' => true,
					'message' => 'Звонок заказан! Мы свяжемся с Вами в ближайшее время.',
				]);
			} else {
				return back()->with('successMessage', 'Звонок заказан! Мы свяжемся с Вами в ближайшее время.');
			}
		}
	}
}