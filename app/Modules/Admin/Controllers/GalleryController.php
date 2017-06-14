<?php
/**
 * Class GalleryController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$galleryImages = $this->getGalleryImages();
		
		return view('admin::gallery.index', compact('galleryImages'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function create()
	{
		$galleryImage = new Gallery();
		
		if(\Request::ajax()) {
			return \Response::json([
				'success' => true,
				'resultHtml' => view('admin::gallery._form', compact('galleryImage'))->render(),
			]);
		}
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function store(Request $request)
	{
		if($request->ajax()) {
			$data = $request->all();
			if($data['is_published']) {
				$data['published_at'] = Carbon::now();
			}
			$position = DB::table('gallery')->max('position');
			$data['position'] = $position + 1;
			
			$validator = \Validator::make($data, Gallery::$rules);
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Изображение не добавлено. Исправьте ошибки.'
				]);
			} else {
				$galleryImage = Gallery::create($data);
				$galleryImage->setImage($request);
				$galleryImage->save();
				
				$galleryImages = $this->getGalleryImages();
				
				return \Response::json([
					'success' => true,
					'message' => 'Изображение успешно добавлено.',
					'itemId' => $galleryImage->id,
					'resultHtml' => view('admin::gallery._table', compact('galleryImages'))->render(),
				]);
			}
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function edit(Request $request, $id)
	{
		$galleryImage = Gallery::find($id);
		
		if(\Request::ajax()) {
			return \Response::json([
				'success' => true,
				'resultHtml' => view('admin::gallery._form', compact('galleryImage'))->render(),
			]);
		}
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function update(Request $request, $id)
	{
		$galleryImage = Gallery::findOrFail($id);
		
		if($request->ajax()) {
			$data = $request->all();
			$rules = Gallery::$rules;
			$rules['image'] = 'image|max:3072';
			$validator = \Validator::make($data, $rules);
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Информация о изображении не обновлена. Исправьте ошибки.'
				]);
			} else {
				if($data['is_published'] != $galleryImage->is_published) {
					$data['published_at'] = $data['is_published'] ? Carbon::now() : null;
				}
				$galleryImage->fill($data);
				$galleryImage->setImage($request);
				$galleryImage->setCategories($request->get('categories'));
				$galleryImage->save();
				
				$galleryImages = $this->getGalleryImages();
				
				return \Response::json([
					'success' => true,
					'message' => 'Информация о изображении успешно обновлена.',
					'itemId' => $galleryImage->id,
					'resultHtml' => view('admin::gallery._table', compact('galleryImages'))->render(),
				]);
			}
		}
	}
	
	/**
	 * Deleting gallery image.
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy(Request $request, $id)
	{
		$galleryImage = Gallery::find($id);
		
		if($galleryImage->delete()) {
			if(\Request::ajax()) {
				$galleryImages = $this->getGalleryImages();
				
				return \Response::json([
					'success' => true,
					'message' => 'Изображение успешно удалёно.',
					'resultHtml' => view('admin::gallery._table', compact('galleryImages'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Изображение успешно удалёно.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Ошибка. Изображение не удалено.'
				]);
			} else {
				return back()->with('errorMessage', 'Ошибка. Изображение не удалено.');
			}
		}
	}
	
	/**
	 * Set active status
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setIsActive(Request $request)
	{
		if($request->ajax()) {
			$review = Gallery::findOrFail($request->get('id'));
			
			if($review) {
				$review->is_published = $request->get('value');
				$review->published_at = $request->get('value') ? Carbon::now() : null;
				$review->save();
				
				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . Gallery::$is_published[$review->is_published] . '".'
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка.'
				]);
			}
		}
	}
	
	/**
	 * Change position of gallery images
	 *
	 * @param Request $request
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function changePosition(Request $request)
	{
		$positions = $request->get('positions');
		$i = 0;
		foreach(array_reverse($positions) as $itemId) {
			$item = Gallery::find($itemId);
			$item->position = $i;
			$item->save();
			$i++;
		}
		
		return \Response::json(array(
			'success' => true,
			'message' => 'Позиция изображения изменена.',
		));
	}
	
	/**
	 * Get list of gallery images
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getGalleryImages()
	{
		return Gallery::all();
//		return Gallery::with(['categories', 'galleryCategories'])->get();
	}
}
