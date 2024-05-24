<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];



    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        // Mendaftarkan jenis exception yang tidak ingin direport
        ValidationException::class
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
        // ketika terjadi exception, code dalam reportable akan dieksekusi, contoh ingin mengirim notif ketika terjadi error
        $this->reportable(function (Throwable $e) {
            print ($e); // contoh ketika terjadi error akan melakukan print erronya

            return false; // return false jika hanya ingin mengeksekusi satu reportable, reportable dibawahnya tidak akan dieksekusi
        });

        // membuat custom view saat terjadi Exception, contohnya ValidationException
        $this->renderable(function (ValidationException $exception, Request $request)
        {
            return response("Bad Request", 400);
        });
    }
}
