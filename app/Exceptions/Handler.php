<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Bots\ErrorsBot;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
     //   dd($exception);
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return response()->error(401, 'Unauthenticated');
        } elseif ($exception instanceof ModelNotFoundException) {
            $model = explode('\\', $exception->getModel());
            $modelName = end($model);
            return response()->error(900, $modelName . ' not found');
        }

        $error = [
            'error-type' => get_class($exception),
            'error-message' => $exception->getMessage(),
            'error-code' => $exception->getCode(),
            'error-file' => $exception->getFile(),
            'error-line' => $exception->getLine(),
            'error-trace' => $exception->getTrace(),
        ];
        
        $route = !is_null($request->route()) ? $request->route()->uri : null;
        
        $errorBotMessage = 'Link visited: '.$request->url().'.';
        if(!is_null($route)){
            $errorBotMessage .= 'Route visited: '.$route.'.';
        }
        $errorBotMessage .= 'Error type: '.get_class($exception).'.';
        $errorBotMessage .= 'Error message: '.$exception->getMessage().'.';
        $errorBotMessage .= 'Error code: '.$exception->getCode().'.';
        $errorBotMessage .= 'Error file: '.$exception->getFile().'.';
        $errorBotMessage .= 'Error line: '.$exception->getLine().'.';
        new ErrorsBot(json_encode($errorBotMessage));
        return response()->json($error);
        
        return parent::render($request, $exception);
    }
}
