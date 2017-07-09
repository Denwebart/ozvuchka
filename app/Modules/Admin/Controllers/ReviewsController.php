<?php
/**
 * Class ReviewsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
	/**
	 * Add new review
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function store(Request $request)
	{
		if($request->ajax()) {
			$data = $request->all();
			$position = DB::table('reviews')->max('position');
			$data['position'] = $position + 1;
			if($data['is_published']) {
				$data['published_at'] = Carbon::now();
			}
			
			$validator = \Validator::make($data, Review::$rules);
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Отзыв не добавлен. Исправьте ошибки.'
				]);
			} else {
				$review = Review::create($data);
				$review->setImage($request);
				$review->save();
				
				$reviews = Review::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Отзыв успешно добавлен.',
					'itemId' => $review->id,
					'resultHtml' => view('admin::reviews.items', compact('reviews'))->render(),
				]);
			}
		}
	}
	
	/**
	 * Delete review
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy(Request $request, $id)
	{
		$review = Review::find($id);
		
		if($review && $review->delete()) {
			if(\Request::ajax()) {
				$reviews = Review::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Отзыв успешно удалён.',
					'resultHtml' => view('admin::reviews.items', compact('reviews'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Отзыв успешно удалён.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка. Отзыв не удалён.'
				]);
			} else {
				return back()->with('warningMessage', 'Произошла ошибка. Отзыв не удалён.');
			}
		}
	}
	
	/**
	 * Set value
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setValue(Request $request)
	{
		if($request->ajax()) {
			$id = $request->has('pk') ? $request->get('pk') : $request->get('id');
			$review = Review::findOrFail($id);
			
			$field = $request->get('name');
			if($review && $field) {
				$data = $request->all();
				$data[$field] = trim($request->get('value')) ? trim($request->get('value')) : '';
				
				$validator = \Validator::make($data, $review->rulesForAttribute($field));
				
				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first($field),
						'message' => 'Значение не изменено. Исправьте ошибки.'
					]);
				} else {
					$review->$field = $data['value'];
					$review->save();
					
					return \Response::json([
						'success' => true,
						'message' => 'Значение успешно изменено.'
					]);
				}
			}
			
			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка.'
			]);
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
			$review = Review::findOrFail($request->get('id'));
			
			if($review) {
				$review->is_published = $request->get('value');
				$review->published_at = $request->get('value') ? Carbon::now() : null;
				$review->save();
				
				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . Review::$is_published[$review->is_published] . '".'
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
	 * Upload image
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function uploadImage(Request $request)
	{
		if($request->ajax()) {
			$review = Review::findOrFail($request->get('id'));
			
			if($review) {
				$review->setImage($request);
				$review->save();
				
				return \Response::json([
					'success' => true,
					'message' => 'Изобржение загружено.'
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
	 * Delete image
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage(Request $request)
	{
		if($request->ajax()) {
			$review = Review::findOrFail($request->get('id'));
			
			if($review) {
				$review->deleteImage();
				$review->deleteImagesFolder();
				$review->save();
				
				return \Response::json([
					'success' => true,
					'message' => 'Изобржение удалено.'
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
	 * Change position of reviews
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
		foreach($positions as $itemId) {
			$item = Review::find($itemId);
			$item->position = $i;
			$item->save();
			$i++;
		}
		
		return \Response::json(array(
			'success' => true,
			'message' => 'Позиция отзыва изменена.',
		));
	}
}