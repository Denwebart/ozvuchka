<?php
/**
 * Class SliderController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
	/**
	 * Add new slider item
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
			$position = DB::table('slider')->max('position');
			$data['position'] = $position + 1;
			
			$validator = \Validator::make($data, Slider::$rules);
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Слайд не добавлен. Исправьте ошибки.'
				]);
			} else {
				$slide = Slider::create($data);
				$slide->setImage($request);
				$slide->save();
				
				$slider = Slider::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Слайд успешно добавлен.',
					'itemId' => $slide->id,
					'resultHtml' => view('admin::slider.items', compact('slider'))->render(),
				]);
			}
		}
	}
	
	/**
	 * Delete slide
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy(Request $request, $id)
	{
		$slide = Slider::find($id);
		
		if($slide && $slide->delete()) {
			if(\Request::ajax()) {
				$slider = Slider::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Слайд успешно удалён.',
					'resultHtml' => view('admin::slider.items', compact('slider'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Слайд успешно удалён.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка. Слайд не удалён.'
				]);
			} else {
				return back()->with('warningMessage', 'Произошла ошибка. Слайд не удалён.');
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
			$slider = Slider::findOrFail($id);
			
			$field = $request->get('name');
			if($slider && $field) {
				$data = $request->all();
				$data[$field] = trim($request->get('value')) ? trim($request->get('value')) : '';
				
				$validator = \Validator::make($data, $slider->getRules($field));
				
				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first($field),
						'message' => 'Значение не изменено. Исправьте ошибки.'
					]);
				} else {
					$slider->$field = $data['value'];
					$slider->save();
					
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
			$slider = Slider::findOrFail($request->get('id'));
			
			if($slider) {
				$slider->is_published = $request->get('value');
				$slider->save();
				
				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . Slider::$is_published[$slider->is_published] . '".'
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
			$slider = Slider::findOrFail($request->get('id'));
			
			if($slider) {
				$slider->setImage($request);
				$slider->save();
				
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
			$slider = Slider::findOrFail($request->get('id'));
			
			if($slider) {
				
				$slider->deleteImage();
				$slider->deleteImagesFolder();
				
				$slider->image = null;
				$slider->save();
				
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
	 * Change position of slider items
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
			$item = Slider::find($itemId);
			$item->position = $i;
			$item->save();
			$i++;
		}
		
		return \Response::json(array(
			'success' => true,
			'message' => 'Позиция слайда изменена.',
		));
	}
}