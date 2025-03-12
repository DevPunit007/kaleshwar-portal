<?php

namespace App\Exceptions;

use App\Mail\ExceptionReport;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;
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
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            $exceptionMail = new ExceptionReport($exception);
            try { Mail::to(env('MAIL_EXCEPTION_RECEIVER'))->send($exceptionMail); } catch (Throwable $exception) {}
        }

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
        if($this->shouldReport($exception) && env('APP_DEBUG') === false) {
            try {
                return response()->view('pages.custom-error');
            } catch(Throwable $exception) {
                return parent::render($request, $exception);
            }
        }

        return parent::render($request, $exception);
    }
}
