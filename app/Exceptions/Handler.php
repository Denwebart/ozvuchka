<?php

namespace App\Exceptions;

use App\Helpers\Errors;
use Exception;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
	
	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Exception $exception
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
    public function render($request, Exception $exception)
    {
	    if ($exception instanceof TokenMismatchException)
	    {
		    if(!$request->ajax()) {
			    return back();
		    } else {
			    return \Response::json([
				    'success' => 'false',
				    'message' => 'Сессия истекла. Обновите страницу и попробуйте снова.'
			    ]);
		    }
	    }
	
	    if ($exception instanceof ModelNotFoundException)
	    {
		    if(!$request->ajax()) {
			    return Errors::error404($request);
		    }
	    }
	    
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
            	'error' => 'Unauthenticated.',
	            'success' => 'false',
	            'message' => 'Сессия истекла. Обновите страницу и попробуйте снова.',
            ], 401);
        }

        return redirect()->guest(route('login'));
    }
}
