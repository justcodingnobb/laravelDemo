<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    	// 购物车里的
    	'shop/cartnums',
        'shop/changecart',
    	'shop/removecart',
    	// 后台文件上传
        'xyshop/attr/uploadimg',
    ];
}
