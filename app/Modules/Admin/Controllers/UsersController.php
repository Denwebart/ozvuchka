<?php

namespace Modules\Admin\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$user = new User();
		
		$backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : \URL::previous();
		
		return view('admin::users.create', compact('user', 'backUrl'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$user = new User();
		$data = $request->except('avatar');
		
		$validator = \Validator::make($data, User::rules());
		
		if ($validator->fails())
		{
			return redirect(route('admin.users.create', ['back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput()
				->with('errorMessage', 'Информация о пользователе не сохранена. Исправьте ошибки.');
		} else {
			$data['password'] = bcrypt($data['password']);
			$data['password_confirmation'] = bcrypt($data['password_confirmation']);
			
			$user->fill($data);
			$user->save();
			
			$user->setImage($request);
			$user->save();
			
			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Пользователь создан!');
			} else {
				return redirect(route('admin.users.edit', ['id' => $user->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Пользователь создан!');
			}
		}
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id)
	{
		if (!\Auth::user()->isAdmin() && \Auth::user()->id != $id) {
			return Errors::error403($request);
		}
		
		$user = User::findOrFail($id);
		
		$backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : \URL::previous();
		
		return view('admin::users.edit', compact('user', 'backUrl'));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if (!\Auth::user()->isAdmin() && \Auth::user()->id != $id) {
			return Errors::error403($request);
		}
		
		$user = User::findOrFail($id);
		$data = $request->except('avatar');
		
		$rules = User::rules($user->id);
		$rules['password'] = 'min:6|max:255|confirmed';
		$validator = \Validator::make($data, $rules);
		
		if ($validator->fails())
		{
			return redirect(route('admin.users.edit', ['id' => $user->id, 'back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput()
				->with('errorMessage', 'Информация о пользователе не сохранена. Исправьте ошибки.');
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
			
			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Информация о пользователе сохранена!');
			} else {
				return redirect(route('admin.users.edit', ['id' => $user->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Информация о пользователе сохранена!');
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
