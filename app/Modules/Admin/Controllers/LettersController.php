<?php

namespace Modules\Admin\Controllers;

use App\Models\Letter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LettersController extends Controller
{
	public function __construct()
	{
		
		$this->middleware('admin', ['only' => ['destroy']]);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$letters = $this->getLetters();
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
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy($id)
	{
		if(\Request::ajax()) {
			if(Letter::destroy($id)){
				$letters = $this->getLetters();
				return \Response::json([
					'success' => true,
					'message' => 'Письмо успешно удалёно.',
					'itemsCount' => view('parts.count')->with('models', $letters)->render(),
					'itemsPagination' => view('parts.pagination')->with('models', $letters)->render(),
					'itemsTable' => view('admin::letters.table')->with('letters', $letters)->render(),
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка, письмо не удалёно.'
				]);
			}
		}
	}
	
	/**
	 * Display a listing of the important letters.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function important()
	{
		$letters = Letter::whereIsImportant(1)->orderBy('created_at', 'DESC')->paginate(20);
		return view('admin::letters.index', compact('letters'));
	}
	
	/**
	 * Display a listing of the deleted letters.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function trash()
	{
		$letters = Letter::whereNotNull('deleted_at')
			->orderBy('created_at', 'DESC')
			->paginate(20);
		return view('admin::letters.index', compact('letters'));
	}
	
	/**
	 * Get list of letters
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getLetters()
	{
		return Letter::whereNull('deleted_at')->orderBy('created_at', 'DESC')->paginate(20);
	}
}
