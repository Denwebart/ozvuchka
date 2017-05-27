<?php
/**
 * Class RequestedCallsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\RequestedCall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class RequestedCallsController extends Controller
{
	public function __construct()
	{
//		$this->middleware('admin', ['only' => ['destroy']]);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$calls = $this->getCalls();
		return view('admin::requestedCalls.index', compact('calls'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function edit($id)
	{
		$call = RequestedCall::find($id);
		
		if(\Request::ajax()) {
			if(is_object($call)) {
				return \Response::json([
					'success' => true,
					'resultHtml' => view('admin::requestedCalls._editForm', compact('call'))->render(),
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Ошибка. Информация о заказанном звонке не загружена.'
				]);
			}
		}
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function update(Request $request, $id)
	{
		$call = RequestedCall::find($id);
		
		if(!is_object($call)) {
			if($request->ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Ошибка. Информация о заказанном звонке не обновлена.'
				]);
			} else {
				return back()->with('errorMessage', 'Ошибка. Информация о заказанном звонке не обновлена.');
			}
		}
		
		$data = $request->all();
		if(!$call->user_id) {
			$data['user_id'] = Auth::user()->id;
			$data['updated_at'] = Carbon::now();
		}
		
		$rules = RequestedCall::rules();
		$rules['status'] = 'integer|between:1,2';
		$messages = ['status.between' => 'Вы не можете сохранить, не выставив статус.'];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			if($request->ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Информация не обновлена. Необходимо исправить ошибки валидации.',
					'errors' => $validator->errors(),
				]);
			} else {
				return back()->withErrors($validator->errors())->withInput()
					->with('errorMessage', 'Информация не обновлена. Необходимо исправить ошибки валидации.');
			}
		} else {
			$call->fill($data);
			$call->save();
			
			if($request->ajax()) {
				$calls = $this->getCalls();
				
				return \Response::json([
					'success' => true,
					'message' => 'Информация успешно обновлена!',
					'resultHtml' => view('admin::requestedCalls._table', compact('calls'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Информация успешно обновлена!');
			}
		}
		
		
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy($id)
	{
		if(RequestedCall::destroy($id)){
			if(\Request::ajax()) {
				$calls = $this->getCalls();
				
				return \Response::json([
					'success' => true,
					'message' => 'Звонок успешно удалён.',
					'resultHtml' => view('admin::requestedCalls._table', compact('calls'))->render(),
				]);
			}
			else {
				return back()->with('successMessage', 'Звонок успешно удалён.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка, звонок не был удалён.'
				]);
			}
			else {
				return back()->with('errorMessage', 'Произошла ошибка, звонок не был удалён.');
			}
		}
	}
	/**
	 * Get list of requested calls
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getCalls()
	{
		return RequestedCall::with('user')
			->orderBy('created_at', 'DESC')
			->paginate(20);
	}
}