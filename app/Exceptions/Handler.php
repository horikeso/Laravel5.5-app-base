<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException as AccessAuthorizationException;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AccessAuthorizationException)
        {
            return response()->view('error.403', [], 403);
        }

        if ($exception instanceof TokenMismatchException)
        {
            return response()->view('error.419', [], 419);
        }

        if ( ! $this->isHttpException($exception))
        {
            return parent::render($request, $exception);
        }

        $status_code = $exception->getStatusCode();

        switch ($status_code)
        {
            case 403:
                return response()->view('error.403', [], $status_code);
                break;
            case 404:
                return response()->view('error.404', [], $status_code);
                break;
            case 500:
                return response()->view('error.500', [], $status_code);
                break;
            case 503:
                return response()->view('error.503', [], $status_code);
                break;
            default:
                return parent::render($request, $exception);
        }
    }

    // 認証されていない場合のリダイレクト先設定の上書き

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if (in_array('backend_web', $exception->guards())) {
            return redirect()->guest(route('backend.login'));
        }

        return redirect()->guest(route('login'));
    }
}
