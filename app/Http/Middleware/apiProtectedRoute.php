<?php

namespace App\Http\Middleware;

use App\Response\Error;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class apiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch (\Exception $exception)
        {
            if($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return Error::tokenInvalid($request);
            }
            elseif($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return Error::tokenExpired($request);
            }
            elseif($exception instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException)
            {
                return Error::tokenBlackListed($request);
            }
            else
            {
                return Error::tokenNotFound($request);
            }
        }
        return $next($request);
    }
}
