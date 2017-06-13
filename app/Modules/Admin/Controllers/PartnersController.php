<?php
/**
 * Class PartnersController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnersController extends Controller
{
	/**
	 * Add new Partner
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
			$position = DB::table('partners')->max('position');
			$data['position'] = $position + 1;
			
			$validator = \Validator::make($data, Partner::$rules);
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Партнер не добавлен. Исправьте ошибки.'
				]);
			} else {
				$partner = Partner::create($data);
				$partner->setImage($request);
				$partner->save();
				
				$partners = Partner::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Партнер успешно добавлен.',
					'itemId' => $partner->id,
					'resultHtml' => view('admin::partners.items', compact('partners'))->render(),
				]);
			}
		}
	}
	
	/**
	 * Delete Partner
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy(Request $request, $id)
	{
		$partner = Partner::find($id);
		
		if($partner && $partner->delete()) {
			if(\Request::ajax()) {
				$partners = Partner::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Партнер успешно удалён.',
					'resultHtml' => view('admin::partners.items', compact('partners'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Партнер успешно удалён.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка. Партнер не удалён.'
				]);
			} else {
				return back()->with('warningMessage', 'Произошла ошибка. Партнер не удалён.');
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
			$partner = Partner::findOrFail($id);
			
			$field = $request->get('name');
			if($partner && $field) {
				$data = $request->all();
				
				$validator = \Validator::make($data, $partner->getRules($field));
				
				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first($field),
						'message' => 'Значение не изменено. Исправьте ошибки.'
					]);
				} else {
					$partner->$field = $data['value'];
					$partner->save();
					
					$response = [
						'success' => true,
						'message' => 'Значение успешно изменено.'
					];
					if(strpos($request->get('name'),'link_') !== false) {
						$response['table'] = 'partners';
						$response['itemId'] = $partner->id;
						$response['fieldName'] = $request->get('name');
						$response['fieldValue'] = $request->get('value');
					}
					
					return \Response::json($response);
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
			$partner = Partner::findOrFail($request->get('id'));
			
			if($partner) {
				$partner->is_published = $request->get('value');
				$partner->save();
				
				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . Partner::$is_published[$partner->is_published] . '".'
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
			$partner = Partner::findOrFail($request->get('id'));
			
			if($partner) {
				$partner->setImage($request);
				$partner->save();
				
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
			$partner = Partner::findOrFail($request->get('id'));
			
			if($partner) {
				$partner->deleteImage();
				$partner->deleteImagesFolder();
				$partner->save();
				
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
	 * Change position of Partners
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
			$menu = Partner::find($itemId);
			$menu->position = $i;
			$menu->save();
			$i++;
		}
		
		return \Response::json(array(
			'success' => true,
			'message' => 'Позиция изменена.',
		));
	}
}