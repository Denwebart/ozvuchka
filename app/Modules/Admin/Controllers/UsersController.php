<?php
/**
 * Class SliderController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Helpers\Errors;
use App\Mail\ActivateAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$users = $this->getUsers();
		
		return view('admin::users.index', compact('users'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		
		return view('admin::users.show', compact('user'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function create(Request $request)
	{
		$user = new User();
		
		if(\Request::ajax()) {
			return \Response::json([
				'success' => true,
				'resultHtml' => view('admin::users._form', compact('user'))->render(),
			]);
		} else {
			return view('admin::users.create', compact('user'));
		}
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function store(Request $request)
	{
		if($request->ajax()) {
			$data = $request->all();
			$validator = \Validator::make($data, User::rules());
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Информация о пользователе не сохранена. Исправьте ошибки.'
				]);
			} else {
				$user = User::create($data);
				$user->setImage($request);
				$user->save();
				
				// Send user message for activation account.
				if($user) {
					Mail::to($user)->send(new ActivateAccount($user, $this->redirectPath()));
				}
				
				$users = $this->getUsers();
				
				return \Response::json([
					'success' => true,
					'message' => 'Пользователь успешно создан.',
					'itemId' => $user->id,
					'resultHtml' => view('admin::users._table', compact('users'))->render(),
				]);
			}
		}
	}
	
	/**
	 * Activation user.
	 *
	 * @param $userId
	 * @param $token
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function activation($userId, $token)
	{
		$user = User::findOrFail($userId);
		
		// Check token in user DB. if null then check data (user make first activation).
		if (!$user->isActive()) {
			// Check token from url.
			if (md5($user->email) == $token) {
				// Change status and login user.
				$user->role = User::ROLE_MODERATOR;
				$user->save();
				
				\Session::flash('flash_message', trans('interface.ActivatedSuccess'));
				
				// Make login user.
				Auth::login($user, true);
				
				// Send user message for activation account.
				Mail::to($user)->send(new ActivateSuccess($user));
			} else {
				// Wrong token.
				\Session::flash('flash_message_error', trans('interface.ActivatedWrong'));
			}
		} else {
			// User was activated early.
			\Session::flash('flash_message_error', trans('interface.ActivatedAlready'));
		}
		
		return \Request::get('redirect')
			? redirect(urldecode(\Request::get('redirect')))
			: redirect('/');
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function edit(Request $request, $id)
	{
		$user = User::find($id);
		
		if (!\Auth::user()->hasAdminPermission() && !\Auth::user()->is($user)) {
			return Errors::error403($request);
		}
		
		if(\Request::ajax()) {
			return \Response::json([
				'success' => true,
				'resultHtml' => view('admin::users._form', compact('user'))->render()
			]);
		} else {
			return view('admin::users.edit', compact('user'));
		}
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);
		
		if (!\Auth::user()->hasAdminPermission() && !\Auth::user()->is($user)) {
			return Errors::error403($request);
		}
		
		if($request->ajax()) {
			$data = $request->all();
			$validator = \Validator::make($data, User::rules($user->id));
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Информация о пользователе не сохранена. Исправьте ошибки.'
				]);
			} else {
				if($data['password']) {
					$data['password'] = bcrypt($data['password']);
					$data['password_confirmation'] = bcrypt($data['password_confirmation']);
				} else {
					unset($data['password']);
				}
				$user->fill($data);
				$user->setImage($request);
				$user->save();
				
				$users = $this->getUsers();
				
				return \Response::json([
					'success' => true,
					'message' => 'Информация о пользователе успешно обновлена.',
					'itemId' => $user->id,
					'resultHtml' => view('admin::users._table', compact('users'))->render(),
				]);
			}
		}
	}
	
	/**
	 * Mark user as deleted.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy(Request $request, $id)
	{
		$user = User::find($id);
		
		if(!$user->isSuperadmin() && !$user->is(\Auth::user())) {
			$user->delete();
			
			if(\Request::ajax()) {
				$users = $this->getUsers();
				
				return \Response::json([
					'success' => true,
					'message' => 'Пользователь успешно удалён.',
					'resultHtml' => view('admin::users._table', compact('users'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Пользователь успешно удалён.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Пользователь ' . $user->login . ' не может быть удалён.'
				]);
			} else {
				return back()->with('warningMessage', 'Пользователь ' . $user->login . ' не может быть удалён.');
			}
		}
	}
	
	/**
	 * Mark user as undeleted
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function undelete(Request $request, $id)
	{
		$user = User::find($id);
		
		if(is_object($user) && !$user->is(\Auth::user())) {
			$user->deleted_at = null;
			$user->save();
			
			if(\Request::ajax()) {
				$users = $this->getUsers();
				
				return \Response::json([
					'success' => true,
					'message' => 'Пользователь успешно восстановлен.',
					'resultHtml' => view('admin::users._table', compact('users'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Пользователь успешно восстановлен.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Ошибка. Пользователь не восстановлен.',
				]);
			} else {
				return back()->with('warningMessage', 'Ошибка. Пользователь не восстановлен.');
			}
		}
	}
	
	/**
	 * Get list of users
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getUsers()
	{
		return User::select('id', 'login', 'email', 'role', 'firstname', 'lastname', 'description', 'avatar', 'created_at', 'deleted_at')
			->orderBy('deleted_at', 'ASC')
			->orderBy(\DB::raw('CASE role
						WHEN 1 THEN 1
                        WHEN 2 THEN 2
                        WHEN 0 THEN 3
                        END'))
			->orderBy('created_at', 'ASC')
			->with(['comments', 'pages', 'requestedCalls'])
			->get();
	}
}
