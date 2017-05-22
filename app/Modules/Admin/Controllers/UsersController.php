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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(\Request::ajax()) {
			
			$user = User::find($id);
			
			if($user->id != 1 || $user->id == \Auth::user()->id) {
				$user->delete();
				
				$users = $this->getUsers();
				
				return \Response::json([
					'success' => true,
					'message' => 'Пользователь успешно удалён.',
					'itemsCount' => view('parts.count')->with('models', $users)->render(),
					'itemsPagination' => view('parts.pagination')->with('models', $users)->render(),
					'itemsTable' => view('admin::users.table')->with('users', $users)->render(),
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Пользователь ' . $user->login . ' не может быть удалён.'
				]);
			}
		}
	}
	
	/**
	 * Undelete the specified resource from storage.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function undelete(Request $request)
	{
		if(\Request::ajax()) {
			
			$user = User::find($request->get('userId'));
			
			if(is_object($user) && ($user->id != 1 || $user->id == \Auth::user()->id)) {
				$user->deleted_at = null;
				$user->is_active = 1;
				$user->save();
				
				$users = $this->getUsers();
				
				return \Response::json([
					'success' => true,
					'message' => 'Пользователь успешно восстановлен.',
					'itemsTable' => view('admin::users.table')->with('users', $users)->render(),
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Ошибка. Пользователь не может быть восстановлен.'
				]);
			}
		}
	}
	
	/**
	 * Get list of users
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getUsers()
	{
		return User::select('id', 'login', 'email', 'role', 'firstname', 'lastname', 'description', 'avatar', 'created_at')
			->orderBy(\DB::raw('CASE role
						WHEN 1 THEN 1
                        WHEN 2 THEN 2
                        WHEN 0 THEN 3
                        END'))
//			->whereIsActive(1)
			->orderBy('is_active', 'DESC')
			->orderBy('created_at', 'ASC')
			->with(['comments', 'pages'])
			->get();
	}
}
