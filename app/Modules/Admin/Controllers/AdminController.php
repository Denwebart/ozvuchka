<?php
/**
 * Class AdminController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	/**
	 * Main page in admin panel
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function index()
	{
		return view('admin::admin.index');
	}
	
	/**
	 * Search
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function search(Request $request)
	{
		$searchQuery = $request->get('query');
		$results = new Collection();
		
		if($searchQuery) {
			
			$pagesResults = Page::select(DB::raw('*, MATCH (alias, title, menu_title, introtext, content) AGAINST ("' . $searchQuery . '") AS score'))
					->where(function($query) use($searchQuery) {
						$query->where('title', 'LIKE', "%$searchQuery%")
							->orWhere('menu_title', 'LIKE', "%$searchQuery%")
							->orWhere('alias', 'LIKE', "%$searchQuery%")
							->orWhere(DB::raw('strip_tags(introtext)'), 'LIKE', "%$searchQuery%")
							->orWhere(DB::raw('strip_tags(content)'), 'LIKE', "%$searchQuery%");
					})
					->with('children', 'user')
//					->whereRaw("MATCH (alias, title, menu_title, introtext, content) AGAINST (? in boolean mode)", [$searchQuery])
					->orderBy('score', 'DESC')
					->get();
			
			$galleryResults = Gallery::select(DB::raw('*, MATCH (title, description, image_alt) AGAINST ("' . $searchQuery . '") AS score'))
				->where(function($query) use($searchQuery) {
					$query->where('title', 'LIKE', "%$searchQuery%")
						->orWhere('description', 'LIKE', "%$searchQuery%")
						->orWhere('image_alt', 'LIKE', "%$searchQuery%");
				})
//				->whereRaw("MATCH (title, description, image_alt) AGAINST (? in boolean mode)", [$searchQuery])
				->orderBy('score', 'DESC')
				->get();
			
			$usersResults = User::select(DB::raw('*, MATCH (login, email, firstname, lastname, description) AGAINST ("' . $searchQuery . '") AS score'))
				->where(function($query) use($searchQuery) {
					$query->where('login', 'LIKE', "%$searchQuery%")
						->orWhere('firstname', 'LIKE', "%$searchQuery%")
						->orWhere('lastname', 'LIKE', "%$searchQuery%")
						->orWhere('email', 'LIKE', "%$searchQuery%")
						->orWhere('description', 'LIKE', "%$searchQuery%");
				})
//				->whereRaw("MATCH (login, email, firstname, lastname, description) AGAINST (? in boolean mode)", [$searchQuery])
				->orderBy('score', 'desc')
				->get();
			
			$results = $results->merge($usersResults)
				->merge($galleryResults)
				->merge($pagesResults)
				->sortByDesc('score')->values()->all();
			
			return view('admin::admin.search', compact('searchQuery','results', 'pagesResults', 'galleryResults', 'usersResults'));
		}
		
		return view('admin::admin.search', compact('searchQuery','results'));
	}
}