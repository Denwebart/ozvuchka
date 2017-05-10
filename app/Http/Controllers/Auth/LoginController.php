<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	/**
	 * Login redirect path.
	 *
	 * @return string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function redirectTo()
	{
		return url()->previous();
	}
	
	/**
	 * Replaced method to use "login" or "password" for login.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{
		$creds = $request->only($this->username(), 'password');
		if (!strpos($creds['email'], '@')) {
			$creds['login'] = $creds['email'];
			unset($creds['email']);
		}
		
		return $creds;
	}
	
	/**
	 * Replaced validate the user login request to use "login" or "password" for login.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return void
	 */
	protected function validateLogin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required_without_all:login',
			'login' => 'required_without_all:email',
			'password' => 'required',
		]);
	}
	
	/**
	 * Check is activated account before attempt login
	 *
	 * @param Request $request
	 * @return boolean
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function isActivated(Request $request)
	{
		$credentials = $this->credentials($request);
		unset($credentials['password']);
		
		$user = User::where($credentials)->first();
		
		return is_object($user) && !$user->isActive() ? false : true;
	}
	
	/**
	 * Replaced for check is active user: Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return LoginController|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 */
	public function login(Request $request)
	{
		$this->validateLogin($request);
		
		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);
			
			return $this->sendLockoutResponse($request);
		}
		
		// Check is activated account before attempt login
		if (!$this->isActivated($request)) {
			return $this->sendFailedLoginResponse($request, trans('auth.notActivated'));
		}
		
		if ($this->attemptLogin($request)) {
			return $this->sendLoginResponse($request);
		}
		
		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);
		
		return $this->sendFailedLoginResponse($request);
	}
	
	/**
	 * Replaced method for ajax: success login
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function sendLoginResponse(Request $request)
	{
		$request->session()->regenerate();
		
		$this->clearLoginAttempts($request);
		
		if ($request->ajax()) {
			return $this->authenticated($request, $this->guard()->user())
				?: response()->json([
					'success' => true,
					'status' => 200,
					'user' => $this->guard()->user(),
					'redirectPath' => $this->redirectPath()
				]);
		}
		
		return $this->authenticated($request, $this->guard()->user())
			?: redirect()->intended($this->redirectPath());
	}
	
	/**
	 * Replaced method for ajax: failed login
	 *
	 * @param Request $request
	 * @param $message
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function sendFailedLoginResponse(Request $request, $message = null)
	{
		if ($request->ajax()) {
			return response()->json([
				'error' => $message ? $message : trans('auth.failed')
			], 401);
		}
		
		return redirect()->back()
			->withInput($request->only($this->username(), 'remember'))
			->withErrors([
				$this->username() => trans('auth.failed'),
			]);
	}
	
	/**
	 * Replaced for redirect to previous page: Log the user out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request)
	{
		$this->guard()->logout();
		
		$request->session()->flush();
		
		$request->session()->regenerate();
		
		return redirect()->intended($this->redirectPath());
	}
}
