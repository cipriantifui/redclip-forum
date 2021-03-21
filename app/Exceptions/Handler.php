<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        TokenExpiredException::class,
        ValidationException::class,
        VoteException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, \Throwable $exception)
    {
        $error = $this->renderJsonErrors([
            'general' => [
                'Internal server error.' . (env('APP_ENV') === 'production' ? '' : $exception)
            ]
        ], Response::HTTP_INTERNAL_SERVER_ERROR);

        if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException) {
            $error = $this->notFound([], null);
        }

        if ($exception instanceof UnauthorizedException || $exception instanceof AuthorizationException) {
            $error = $this->unauthorized($request, $exception);
        }

        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            $error = $this->unauthorized($request, $exception);
        }

        if($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException){
            $error = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthenticationException) {
            $error = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof UnprocessableEntityHttpException) {
            $error = $this->unprocessableEntity($exception);
        }

        if ($exception instanceof VoteException) {
            $error = $this->unprocessableEntity($exception);
        }

        if ($exception instanceof ValidationException) {
            $error = $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof MethodNotAllowedHttpException || $exception instanceof \BadMethodCallException) {
            $error = $this->methodNotAllowed($request, $exception);
        }

        if($exception instanceof AuthException){
            $error = $this->unprocessableEntityError(($exception->getMessage()));
        }

        if ($exception instanceof TokenMismatchException) {
            $error = $this->sessionExpired();
        }

        return $error;
    }

    public function renderJsonErrors($errors, $status, $data = null)
    {
        return response()->json([
            "errors" => $errors,
            "data" => $data,
            "status" => $status,
            "statusText" => Response::$statusTexts[$status]
        ], $status);
    }

    protected function notFound($request, $exception)
    {
        return $this->renderJsonErrors([
            'general' => [
                'Not found.'
            ]
        ], Response::HTTP_NOT_FOUND);
    }


    protected function methodNotAllowed($request, $exception)
    {
        return $this->renderJsonErrors([
            'general' => [
                'Method not allowed'
            ]
        ], Response::HTTP_METHOD_NOT_ALLOWED);
    }

    protected function unauthorized($request, $exception)
    {
        return $this->renderJsonErrors([
            'general' => [
                'Forbidden.'
            ]
        ], Response::HTTP_FORBIDDEN);
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param ValidationException $e
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->renderJsonErrors($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function unprocessableEntity($exception)
    {
        return $this->renderJsonErrors([
            'general' => [
                $exception->getMessage()
            ],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param Request $request
     * @param $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthenticated($request, $exception)
    {
        return $this->renderJsonErrors([
            'general' => [
                'Unauthenticated.'
            ]
        ], Response::HTTP_UNAUTHORIZED);
    }

    private function unprocessableEntityError($message)
    {
        return $this->renderJsonErrors([
            'error' => $message
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function sessionExpired(){
        return redirect()
            ->back()
            ->withErrors(['token_error' => 'Sorry, your session seems to have expired. Please try again.']);
    }
}
