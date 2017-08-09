<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
    public function render($request, Exception $e)
    {
        if($this->isHttpException($e))
        {
            switch ($e->getStatusCode()) {

                case 404:

                    $e->err = "Page Not Found : 404";
                    $e->msg = "Sorry - Page Not Found!";
                    $e->descp = "The page you are looking for was moved, removed, renamed or might never existed. You stumbled upon a broken link";
                    return response()->view('errors.err',['e' => $e],404);
                    break;

                case 401:

                    $e->err = "Unauthorized : 401";
                    $e->msg = "Sorry - Authentication is required!";
                    $e->descp = "To navigate in the website you should log in first";
                    return response()->view('errors.err',['e' => $e],401);
                    break;

              case 400:

                        $e->err = "Bad Request : 400";
                        $e->msg = "Sorry - Page Not Found!";
                        $e->descp = "The server cannot or will not process the request due to an apparent client error";
                        return response()->view('errors.err',['e' => $e],400);
                        break;

              case 403:

                        $e->err = "Forbidden : 403";
                        $e->msg = "Sorry - Permission issues!";
                        $e->descp = "The request was valid, but the server is refusing action. The user might not have the necessary permissions for a resource, or may need an account of some sort";
                        return response()->view('errors.err',['e' => $e],403);
                        break;
              
              case 405:

                            $e->err = "Method Not Allowed : 405";
                            $e->msg = "Sorry - Method requested is invalid!";
                            $e->descp = "A request method is not supported for the requested resource";
                            return response()->view('errors.err',['e' => $e],405);
                            break;

                // internal server error
                case '500':
                $e->err = "Page Not Found : 500";
                $e->msg = "message";
                $e->descp = "Description";
                    return response()->view('errors.500',[],500);
                    break;
                default:
                    return $this->renderHttpException($e);
                    break;
            }
        }
        return parent::render($request, $e);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
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

        return redirect()->guest(route('login'));
    }
}
