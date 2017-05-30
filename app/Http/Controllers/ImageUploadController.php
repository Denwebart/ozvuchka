<?php
/**
 * Class ImageUploadController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Http\Controllers;

use App\Helpers\Translit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageUploadController extends BaseController
{
	/**
	 * Загрузка временного изображения
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function uploadIntoTemp(Request $request)
	{
		if($request->ajax()) {
			$data = $request->all();
			
			$rules = [
				'image' => 'mimes:jpeg,bmp,png|max:2048|required_without_all:avatar',
			];
			
			$validation = \Validator::make($data, $rules);
			
			if ($validation->fails())
			{
				return \Response::json([
					'fail' => true,
					'message' => 'Ошибка при загрузке изображения.',
					'errors' => $validation->getMessageBag()->toArray(),
				]);
			}
			
			$file = $data['image'];
			
			$fileName = Translit::generateFileName($file->getClientOriginalName());
			
			$tempPath = $request->get('tempPath');
			
			$imagePath = public_path() . $tempPath;
			$image = Image::make($file->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);
			
			// водяной знак
			if($request->get('watermark', true)) {
				$watermark = Image::make(public_path('images/watermark.png'));
				$watermark->resize(($image->width() * 2) / 3, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . 'watermark.png');
				
				$image->insert($imagePath . 'watermark.png', 'center');
			}
			$isDeleted = $request->get('isDeleted', true);
			
			if(\Config::get('image.maxImageWidth') && $image->width() > \Config::get('image.maxImageWidth')) {
				$image->resize(\Config::get('image.maxImageWidth'), null, function ($constraint) {
					$constraint->aspectRatio();
				});
			}
			if(\Config::get('image.maxImageHeight') && $image->height() > \Config::get('image.maxImageHeight')) {
				$image->resize(null, \Config::get('image.maxImageHeight'), function ($constraint) {
					$constraint->aspectRatio();
				});
			}
			
			$image->save($imagePath . $fileName);
			
			$imageUrl = $tempPath . $fileName;
			
			if(File::exists($imagePath . 'watermark.png')) {
				File::delete($imagePath . 'watermark.png');
			}
			
			if($request->get('field', 'image') == 'avatar') {
				$cropSize = ($image->width() < $image->height()) ? $image->width() : $image->height();
				$image->crop($cropSize, $cropSize)
					->resize(50, null, function ($constraint) {
						$constraint->aspectRatio();
					})->save($imagePath . 'mini_' . $fileName);
			}
			
			return \Response::json(array(
				'success' => true,
				'message' => 'Изображение загружено во временную папку.',
				'imageUrl' => $imageUrl,
			));
		}
	}
	
	/**
	 * Удаление временного изображения
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteFromTemp(Request $request)
	{
		if($request->ajax())
		{
			$image = $request->get('imageName');
			$tempPath = $request->get('tempPath');
			
			// delete old image with directory
			if(File::exists(public_path() . $tempPath . $image)) {
				File::delete(public_path() . $tempPath . $image);
			}
			
			return \Response::json([
				'success' => true,
				'message' => 'Изображение удалено.',
			]);
		}
	}
}