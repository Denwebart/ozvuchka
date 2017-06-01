<?php

namespace Modules\Admin\Controllers;

use App\Models\Letter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LettersController extends Controller
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
		$letters = $this->getLetters(\Route::current()->getName());
		
		return view('admin::letters.index', compact('letters'));
	}
	
	/**
	 * Display a listing of the important letters.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function important()
	{
		$letters = $this->getLetters(\Route::current()->getName());
		
		return view('admin::letters.index', compact('letters'));
	}
	
	/**
	 * Display a listing of the deleted letters.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function trash()
	{
		$letters = $this->getLetters(\Route::current()->getName());
		
		return view('admin::letters.index', compact('letters'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$letter = Letter::findOrFail($id);
		if(is_null($letter->read_at)) {
			$letter->read_at = Carbon::now();
			$letter->save();
		}
		return view('admin::letters.show', compact('letter'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy(Request $request, $id)
	{
		$letter = Letter::find($id);
		$route = $request->get('route', 'admin.letters.index');
		if($letter) {
			if($letter->delete()){
				$letters = $this->getLetters($route);
				
				if(\Request::ajax()) {
					return \Response::json([
						'success' => true,
						'message' => 'Письмо успешно удалено.',
						'resultHtml' => view('admin::letters._table', compact('letters'))->with('route', $route)->render(),
					]);
				} else {
					return back()->with('successMessage', 'Письмо успешно удалено.');
				}
			} else {
				$letters = $this->getLetters($route);
				
				if(\Request::ajax()) {
					return \Response::json([
						'success' => true,
						'message' => 'Письмо успешно перемещено в корзину.',
						'resultHtml' => view('admin::letters._table', compact('letters'))->with('route', $route)->render(),
					]);
				} else {
					return back()->with('successMessage', 'Письмо успешно перемещено в корзину.');
				}
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка, письмо не удалёно.',
				]);
			} else {
				return back()->with('dangerMessage', 'Произошла ошибка, письмо не удалёно.');
			}
		}
	}
	
	/**
	 * Get list of letters
	 *
	 * @param string $route
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getLetters($route = 'admin.letters.index')
	{
		$query = new Letter();
		
		if($route == 'admin.letters.trash') {
			$query = $query->whereNotNull('deleted_at');
		} elseif ($route == 'admin.letters.important') {
			$query = $query->whereIsImportant(1);
		} else {
			$query = $query->whereNull('deleted_at');
		}
		
		$letters = $query->orderBy('created_at', 'DESC')->paginate(20);
		return $letters;
	}
}
