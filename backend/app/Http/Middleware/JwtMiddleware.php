<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response([
                "error" => ["message" => 'token expired']
            ], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response([
                "error" => ["message" => 'invalid token']
            ], $e->getCode());
        } catch (JWTException $e) {
            return response([
                "error" => ["message" => 'token is missing']
            ], $e->getCode());
        }

        return $next($request);
    }
}
