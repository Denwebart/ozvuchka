<?php

namespace Modules\Admin\Controllers;

use App\Helpers\Translit;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PagesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function index()
	{
		$pages = $this->getPages();
		
		return view('admin::pages.index', compact('pages'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function create(Request $request)
	{
		$page = new Page();
		$page->is_published = Page::PUBLISHED;
		if($request->has('type') && array_key_exists($request->get('type'), Page::$types) && $request->get('type') != Page::TYPE_SYSTEM_PAGE) {
			$page->type = $request->get('type');
		}
		
		$backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();
		
		return view('admin::pages.create', compact('page', 'backUrl'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$page = new Page();
		$data = $request->except('image');
		$data = array_merge($data, $page->setData($data));
		$pageTitle = $data['menu_title'] ? $data['menu_title'] : $data['title'];
		$data['alias'] = Translit::generateAlias($pageTitle, $data['alias']);
		
		$validator = \Validator::make($data, Page::rules());
		
		if ($validator->fails())
		{
			return redirect(route('admin.pages.create', ['back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput($data)
				->with('errorMessage', 'Страница не сохранена. Исправьте ошибки.');
		} else {
			$page->fill($data);
			$page->save();
			
			$page->setImage($request);
			$page->save();
			
			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Страница создана!');
			} else {
				return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Страница создана!');
			}
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function edit($id)
	{
		$page = Page::findOrFail($id);
		
		$backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();
		
		return view('admin::pages.edit', compact('page', 'backUrl'));
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
		$page = Page::findOrFail($id);
		$data = $request->except('image');
		$data = array_merge($data, $page->setData($data));
		$pageTitle = $data['menu_title'] ? $data['menu_title'] : $data['title'];
		if(!$page->isMain()) {
			$data['alias'] = Translit::generateAlias($pageTitle, $data['alias']);
		} else {
			$data['alias'] = '/';
		}
		
		$rules = Page::rules($page->id);
		$messages = [];
		// validation rule for main page
		if($page->isMain()) {
			$rules['alias'] = 'regex:/^[\/]+$/u';
			$messages['alias.regex'] = 'Алиас главной страницы нельзя изменить.';
		}
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput()
				->with('errorMessage', 'Страница не сохранена. Исправьте ошибки.');
		} else {
			if(count($page->menus)) {
				foreach (['alias', 'title', 'menu_title', 'parent_id', 'is_published'] as $attribute) {
					if ($page->$attribute != $data[$attribute]) {
						\Cache::forget('menuItems');
						break;
					}
				}
			}
			
			$page->fill($data);
			$page->setImage($request);
			$page->save();
			
			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Страница сохранена!');
			} else {
				return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Страница сохранена!');
			}
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)	 */
	public function destroy($id)
	{
		$page = Page::find($id);
		if($page->canBeDeleted()) {
			$page->delete();
			
			$pages = $this->getPages();
			
			if(\Request::ajax()) {
				return \Response::json([
					'success' => true,
					'message' => 'Страница успешно удалена.',
					'resultHtml' => view('admin::pages._table', compact('pages'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Страница успешно удалена.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Эта страница не может быть удалена.'
				]);
			} else {
				return back()->with('warningMessage', 'Эта страница не может быть удалена.');
			}
		}
	}
	
	/**
	 * Change published status.
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)	 */
	public function changePublishedStatus($id)
	{
		if(\Request::ajax()) {
			
			$page = Page::find($id);
			if($page->canBeDeleted()) {
				$page->delete();
				
				$pages = $this->getPages();
				
				return \Response::json([
					'success' => true,
					'message' => 'Страница успешно удалена.',
					'resultHtml' => view('admin::pages._table', compact('pages'))->render(),
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Эта страница не может быть удалена.'
				]);
			}
		}
	}
	
	/**
	 * Get list of pages
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getPages()
	{
		return Page::select(['id', 'parent_id', 'alias', 'type', 'is_container', 'is_published', 'title', 'menu_title', 'meta_title', 'meta_desc', 'meta_key'])
			->with('parent', 'children')
			->get();
	}
}
