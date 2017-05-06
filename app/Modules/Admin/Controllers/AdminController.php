<?php
/**
 * Class AdminController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

class AdminController extends Controller
{
	/**
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('admin::admin.index');
	}
}