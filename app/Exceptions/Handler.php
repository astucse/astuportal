<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        // if ($exception instanceof ModelNotFoundException or $exception instanceof NotFoundHttpException) {
        //     // ajax 404 json feedback
        //     if ($request->ajax()) {
        //         // echo "1111";
        //         // exit();
        //         return response()->json(['error' => 'Not Found'], 404);
        //     }

        //     // echo "2222";
        //     // exit();
        //     // normal 404 view page feedback
        //     return response()->view('errors.missing', [], 404);
        // }
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception){
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                $login = 'login.admin';
                break;
                
            case 'student':
                $login = 'login.student';
                break;

            case 'employee':
                $login = 'login.employee';
                break;
        }

        return redirect()->guest(route($login));
    }
}
