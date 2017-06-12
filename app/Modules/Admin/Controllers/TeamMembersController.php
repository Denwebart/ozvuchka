<?php
/**
 * Class TeamMembersController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\TeamMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamMembersController extends Controller
{
	/**
	 * Add new Team Member
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
			$position = DB::table('team_members')->max('position');
			$data['position'] = $position + 1;
			
			$validator = \Validator::make($data, TeamMember::$rules);
			
			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Член команды не добавлен. Исправьте ошибки.'
				]);
			} else {
				$teamMember = TeamMember::create($data);
				$teamMember->setImage($request);
				$teamMember->save();
				
				$teamMembers = TeamMember::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Член команды успешно добавлен.',
					'itemId' => $teamMember->id,
					'resultHtml' => view('admin::teamMembers.items', compact('teamMembers'))->render(),
				]);
			}
			
			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка.'
			]);
		}
	}
	
	/**
	 * Delete Team Member
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function destroy(Request $request, $id)
	{
		$teamMember = TeamMember::find($id);
		
		if($teamMember && $teamMember->delete()) {
			if(\Request::ajax()) {
				$teamMembers = TeamMember::all();
				
				return \Response::json([
					'success' => true,
					'message' => 'Член команды успешно удалён.',
					'resultHtml' => view('admin::teamMembers.items', compact('teamMembers'))->render(),
				]);
			} else {
				return back()->with('successMessage', 'Член команды успешно удалён.');
			}
		} else {
			if(\Request::ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка. Член команды не удалён.'
				]);
			} else {
				return back()->with('warningMessage', 'Произошла ошибка. Член команды не удалён.');
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
			$teamMember = TeamMember::findOrFail($id);
			
			$field = $request->get('name');
			if($teamMember && $field) {
				$data = $request->all();
				$data[$field] = trim($request->get('value')) ? trim($request->get('value')) : '';
				
				$validator = \Validator::make($data, $teamMember->getRules($field));
				
				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first($field),
						'message' => 'Значение не изменено. Исправьте ошибки.'
					]);
				} else {
					$teamMember->$field = $data['value'];
					$teamMember->save();
					
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
			$teamMember = TeamMember::findOrFail($request->get('id'));
			
			if($teamMember) {
				$teamMember->is_published = $request->get('value');
				$teamMember->save();
				
				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . TeamMember::$is_published[$teamMember->is_published] . '".'
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
			$teamMember = TeamMember::findOrFail($request->get('id'));
			
			if($teamMember) {
				$teamMember->setImage($request);
				$teamMember->save();
				
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
			$teamMember = TeamMember::findOrFail($request->get('id'));
			
			if($teamMember) {
				$teamMember->deleteImage();
				$teamMember->save();
				
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
	 * Change position of Team Members
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
			$menu = TeamMember::find($itemId);
			$menu->position = $i;
			$menu->save();
			$i++;
		}
		
		return \Response::json(array(
			'success' => true,
			'message' => 'Позиция члена команды изменена.',
		));
	}
}