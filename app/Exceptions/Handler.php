<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        //
    }

    public function render($request, Throwable $exception)
{
    // Debug dinonaktifkan tapi kita tampilkan pesan error custom
    if (!config('app.debug')) {
        return response()->view('errors.simple', [
            'exception' => $exception,
            'message' => $exception->getMessage()
        ], 500);
    }

    return parent::render($request, $exception);
}
}
