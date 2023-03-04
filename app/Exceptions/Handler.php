<?php

namespace App\Exceptions;

use App\Common\Response\RespResult;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
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
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        if ($this->shouldntReport($exception)) {
            return;
        }

        $errInfo = [
            'url' => request()->url(),
            'method' => request()->method(),
            'error_code' => $exception->getCode(),
            'error_message' => $exception->getMessage(),
            'error_line' => $exception->getLine(),
            'error_file' => $exception->getFile(),
        ];
        Log::error("exception err", $errInfo);

//        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            return RespResult::error($exception->getCode(), $exception->getMessage());
        }

        return parent::render($request, $exception);
    }
}
