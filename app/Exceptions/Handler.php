<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // Store in a log the 404 codes with the route and IP
    public function render($request, Throwable $exception)
    {
        // Handle 404 errors
        if ($exception instanceof NotFoundHttpException) {
            // Log the 404 error
            $this->log404Error($request);
        }

        return parent::render($request, $exception);
    }

    /**
     * Log 404 errors along with route and IP information.
     *
     * @param \Illuminate\Http\Request $request
     */
    protected function log404Error($request)
    {
        $logMessage = sprintf(
            '404 Error: Route: "%s" | IP: %s',
            $request->fullUrl(),
            $request->ip()
        );

        // Log the error to a file (in /config/loggin.php)
        Log::channel('404')->info($logMessage);
    }
}
