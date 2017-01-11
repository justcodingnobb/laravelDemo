<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class Jwt extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        // if (! $token = $this->auth->setRequest($request)->getToken()) {
        if (! $token = $request->token) {
            return $this->response->json(['error_code'=>2,'message' => 'token_not_provided','data'=>400]);
        }
        try {
            // $this->auth->getPayload($token)->get('sub');
            $user = $this->auth->authenticate($token);
            
        } catch (TokenExpiredException $e) {
            return $this->response->json(['error_code'=>2,'message' => 'token_expired','data'=>$e->getStatusCode()]);
        } catch (JWTException $e) {
            return $this->response->json(['error_code'=>2,'message' => 'token_invalid','data'=>$e->getStatusCode()]);
        }
        // 没用户
        if (! $user) {
            return $this->response->json(['error_code'=>2,'message' => 'user_not_found','data'=>404]);
        }
        // 用户token跟这个token是否一样
        if ($user->token != $token && $request->ish5 != 1) {
            return $this->response->json(['error_code'=>2,'message' => '用户在其它手机上登陆过！','data'=>404]);
        }
        $this->events->fire('tymon.jwt.valid', $user);
        
        // ->header('Cache-Control','max-age=360000, public')
        return $next($request);
    }
}
