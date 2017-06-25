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
        /*$export = ['xyshop/good/goodattr','xyshop/good/goodspec','xyshop/good/goodspecinput'];
        if (in_array($request->path(), $export) || $request->isMethod('post')) {
            session()->reflash();
            return $respond;
        }*/
        // 记录上次请求的url path，返回时用
        session()->flash('backurl',$request->fullUrl());
        return $respond;
    }
}
