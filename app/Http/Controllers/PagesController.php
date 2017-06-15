<?php

namespace App\Http\Controllers;

use App\Mail\FromContactformToAdmin;
use App\Mail\FromContactformToUser;
use App\Models\GalleryCategory;
use App\Models\Letter;
use App\Models\Page;
use App\Models\RequestedCall;
use App\Models\User;
use App\Widgets\Gallery\Gallery;
use App\Widgets\News\News;
use App\Widgets\Partners\Partners;
use App\Widgets\Reviews\Reviews;
use App\Widgets\Slider\Slider;
use App\Widgets\TeamMembers\TeamMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
	/**
	 * Show the application main page.
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function index() {
		
		$page = Page::whereAlias('/')->firstOrFail();
		
		$slider = new Slider();
		
		$gallery = new Gallery();
		
		$latestNews = new News();
		
		$services = \Cache::rememberForever('widgets.services', function() {
			return Page::whereParentId(Page::ID_SERVICES_PAGE)->with([
				'parent' => function($q) {
					$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
				}
			])->limit(6)->get(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title', 'introtext', 'image', 'image_alt']);
		});
		
		return view('pages.index', compact('page', 'slider', 'gallery', 'latestNews', 'services'));
	}
	
	/**
	 * Show the application pages.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param object $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function pageOneLevel(Request $request, $page)
	{
		return $this->renderPage($request, $page);
	}
	
	public function pageTwoLevel(Request $request, $parentOne, $page)
	{
		return $this->renderPage($request, $page);
	}
	
	public function pageThreeLevel(Request $request, $parentOne, $parentTwo, $page)
	{
		return $this->renderPage($request, $page);
	}
	
	public function pageFourLevel(Request $request, $parentOne, $parentTwo, $parentThree, $page)
	{
		return $this->renderPage($request, $page);
	}
	
	protected function renderPage($request, $page)
	{
		if(!is_a($page, 'App\Models\Page') || url($request->getPathInfo()) != $page->getUrl()) {
			abort(404);
		}
		
		switch ($page->id) {
			case Page::ID_ABOUT_PAGE:
				return $this->getAboutPage($request, $page);
			case Page::ID_SERVICES_PAGE:
				return $this->getServicesPage($request, $page);
			case Page::ID_NEWS_PAGE:
				return $this->getNewsPage($request, $page);
			case Page::ID_PARTNERS_PAGE:
				return $this->getPartnersPage($request, $page);
			case Page::ID_GALLERY_PAGE:
				return $this->getGalleryPage($request, $page);
			case Page::ID_CONTACT_PAGE:
				return $this->getContactPage($request, $page);
			case Page::ID_SITEMAP_PAGE:
				return $this->getSitemapPage($request, $page);
		}
		
		if($page->parent_id == Page::ID_NEWS_PAGE) {
			return $this->getNewsPostPage($request, $page);
		}
		
		if($page->is_container) {
			return $this->getCategoryPage($request, $page);
		} else {
			return $this->getPage($request, $page);
		}
	}
	
	/**
	 * Get page info
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getPage($request, $page)
	{
		return view('pages.page', compact('page'));
	}
	
	/**
	 * About page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getAboutPage($request, $page)
	{
		$teamMembers = new TeamMembers();
		
		return view('pages.about', compact('page', 'teamMembers'));
	}
	
	/**
	 * Services page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getServicesPage($request, $page)
	{
		$services = $page->children()->with([
			'parent' => function($q) {
				$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
			}
		])->get(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title', 'introtext', 'image', 'image_alt']);
		
		return view('pages.services', compact('page', 'services'));
	}
	
	/**
	 * Partners page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getPartnersPage($request, $page)
	{
		$partners = new Partners();
		
		return view('pages.partners', compact('page', 'partners'));
	}
	
	/**
	 * News page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getNewsPage($request, $page)
	{
		// доделать рекурсивно, вынести в отдельный метод, повторяется в getCategoryPage
		$subcategories = \Cache::rememberForever('page.subcategories.' . $page->id, function() use($page) {
			return $page->children()
				->with([
					'parent' => function($q) {
						$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
					}
				])->whereIsContainer(1)
				->get(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
		});
		$subcategoryIds = $subcategories->pluck('id');
		$subcategoryIds[] = $page->id;
		
		$query = Page::whereIn('parent_id', $subcategoryIds)
			->published()->whereIsContainer(0)
			->with([
				'parent' => function($q) {
					$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
				}
			]);
		$query = $query->orderBy('published_at', 'DESC');
		$news = $query->get();
		
		$latestNews = new News();
		$reviews = new Reviews();
		
		return view('pages.news', compact('page', 'news', 'subcategories', 'latestNews', 'reviews'));
	}
	
	/**
	 * News post page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getNewsPostPage($request, $page)
	{
		$latestNews = new News();
		$reviews = new Reviews();
		
		return view('pages.newsPost', compact('page', 'latestNews', 'reviews'));
	}
	
	/**
	 * Gallery page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getGalleryPage($request, $page)
	{
		$galleryImages = \Cache::rememberForever('pages.gallery.galleryImages', function() {
			return \App\Models\Gallery::published()
				->with('categories')->get();
		});
		
		$galleryCategories = \Cache::rememberForever('pages.gallery.galleryCategories', function() {
			return GalleryCategory::has('galleryImages')->get();
		});
		
		return view('pages.gallery', compact('page', 'galleryImages', 'galleryCategories'));
	}
	
	/**
	 * Contact page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getContactPage($request, $page)
	{
		return view('pages.contact', compact('page'));
	}
	
	/**
	 * Page with articles from category
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getCategoryPage($request, $page)
	{
		// доделать рекурсивно
		$subcategories = \Cache::rememberForever('page.subcategories.' . $page->id, function() use($page) {
			return $page->children()
				->with([
					'parent' => function($q) {
						$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
					}
				])
				->has('children')->whereIsContainer(1)
				->get(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
		});
		$subcategoryIds = $subcategories->pluck('id');
		$subcategoryIds[] = $page->id;
		
		// доделать сортировку
//		if($request->has('sortby') && !$request->get('reset-filters') && in_array($request->get('sortby'), Page::$sortingAttributes)) {
//			$sortby = $request->get('sortby');
//		} else {
//			$sortby = $request->cookie('sortby', 'popular');
//		}
//		$direction = $request->has('direction') ? $request->get('direction') : $request->cookie('direction', 'DESC');
		
		$query = Page::whereIn('parent_id', $subcategoryIds)->published()->whereIsContainer(0);
		$query = $query->with([
			'parent' => function($q) {
				$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
			},
		]);
		$query = $query->orderBy('published_at', 'DESC');
		$articles = $query->get();
		
		$latestNews = new News();
		$reviews = new Reviews();
		
		if(!$request->ajax()) {
			return view('pages.category', compact('page', 'articles', 'subcategories', 'latestNews', 'reviews'));
		} else {
//			return \Response::json([
//				'success' => true,
//				'productsListHtml' => view('parts.productsList', compact('products'))->render(),
//				'countHtml' => view('parts.count')->with('models', $products)->render(),
//				'pageUrl' => isset($url) ? $url : $products->url($request->get('page', 1)),
//			])->withCookie(cookie()->forever('catalog-onpage', $limit))
//				->withCookie(cookie()->forever('sortby', strtolower($sortby)))
//				->withCookie(cookie()->forever('direction', strtolower($direction)));
		}
	}
	
	/**
	 * HTML Sitemap page
	 *
	 * @param $request
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getSitemapPage($request, $page)
	{
		$sitemapItems = \Cache::rememberForever('sitemapItems', function() {
			return Page::whereParentId(0)
				->published()
				->get(['id', 'parent_id', 'user_id', 'type', 'is_container', 'alias', 'title', 'menu_title']);
		});
		
		return view('pages.sitemap', compact('page', 'sitemapItems'));
	}
	
	/**
	 * XML Sitemap
	 *
	 * @return \Illuminate\Contracts\View\View
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function sitemapXml()
	{
		$sitemapItems = Page::whereParentId(0)
			->published()
			->get(['id', 'parent_id', 'user_id', 'type', 'is_container', 'alias', 'title', 'menu_title', 'updated_at', 'published_at']);
		
		$content = \View::make('pages.sitemapXml', compact('sitemapItems'))->render();
		
		return response($content)->header('Content-Type', 'text/xml');
	}
	
	/**
	 * Sending letter from contact form
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function sendLetter(Request $request)
	{
		$data = $request->all();
		$validator = \Validator::make($data, Letter::$rules);
		
		if($validator->fails()) {
			if($request->ajax()) {
				return \Response::json([
					'success' => false,
					'message' => 'Письмо не отправлено. Исправьте ошибки.',
					'errors' => $validator->errors()
				]);
			} else {
				return back()->withErrors($validator->errors())->withInput()
					->with('errorMessage', 'Письмо не отправлено. Исправьте ошибки.');
			}
		}
			
		if($letter = Letter::create($data)) {
			
//			Notification::forAllUsers(Notification::TYPE_NEW_LETTER, [
//				'[linkToLetter]' => route('admin.letters.show', ['id' => $letter->id]),
//				'[letterFromEmail]' => $letter->email,
//				'[letterFromName]' => $letter->name,
//				'[letterSubject]' => $letter->subject,
//				'[letterText]' => $letter->message,
//				'[letterCreatedAt]' => $letter->created_at,
//			]);
			
			// Email to user
			if($request->get('send_copy')) {
				Mail::to($request->get('email'))->send(new FromContactformToUser($letter));
			}
			
			// Email to admin
			$admins = User::whereRole(User::ROLE_ADMIN)->active()->get();
			foreach ($admins as $admin) {
				Mail::to($admin->email)->send(new FromContactformToAdmin($letter));
			}
			
			if($request->ajax()) {
				return \Response::json([
					'success' => true,
					'message' => 'Ваше письмо успешно отправлено!',
				]);
			} else {
				return back()->with('successMessage', 'Ваше письмо успешно отправлено!');
			}
		}
	}
	
	/**
	 * Remember in cookie
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function rememberInCookie(Request $request)
	{
		if($request->ajax() && $request->get('key')) {
			return \Response::json([
				'success' => true,
			])->withCookie(cookie()->forever($request->get('key'), $request->get('value')));
		}
	}
}
