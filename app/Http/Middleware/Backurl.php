<?php

namespace App\Http\Middleware;

use Closure;

class Backurl
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
        $respond = $next($request);
        // 记录上次请求的url path，返回时用
        session()->flash('backurl',$request->path());
        return $respond;
    }
}
