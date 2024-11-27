<?php

namespace App\Exceptions;

use App\Http\Traits\Responser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use Responser;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

    }

        public function render($request, Throwable $e): mixed {
        if ($e instanceof TokenExpiredException) {
            return $this->responseFail(status: 401, message: 'Token expired');
        }

        if ($e instanceof TokenBlacklistedException) {
            return $this->responseFail(status: 401, message: 'Token blacklisted');
        }
        if ($e instanceof TokenInvalidException) {
            return $this->responseFail(status: 401, message: 'Token invalid');
        }
        if ($e instanceof JWTException) {
            return $this->responseFail(status: 401, message: 'JWT error');
        }
        if ($e instanceof ModelNotFoundException) {
            return $this->responseFail(status: 404, message: 'Wrong Model Id');
        }
        if ($e instanceof AuthenticationException) {
            if($request->expectsJson()) {
                return $this->responseFail(status: 401, message: 'Unauthenticated');
            } else {
                return redirect()->route('loginForm');
            }
        }

        if ($e instanceof HttpException) {
            if ($e->getStatusCode() == 403)
                return $this->responseFail(status: 403, message: __('messages.You Are Not Authorized For This Action'));
        }


        return parent::render($request, $e);
    }
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->all();
        if($this->isFrontend($request))
        {
            return $request->ajax() ? response()->json($errors , 422) : redirect()->back()->withInput($request->input())->withErrors($errors);
        }

        return $this->responseFail(message: 'Validation error', data: $errors);
    }
    private function isFrontend($request)
    {
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }
}
