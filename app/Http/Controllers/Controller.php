<?php

namespace App\Http\Controllers;

use App\Helpers\Settings;
use App\Models\Setting;
use App\Widgets\Menu\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct(Settings $settings)
	{
		\View::share('siteSettings', $settings->getCategory(Setting::CATEGORY_SITE));
		\View::share('menuWidget', new Menu());
	}
}
