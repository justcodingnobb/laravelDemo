<?php
/***************************************************************************
 * 
 * Copyright (c) 2014 Baidu.com, Inc. All Rights Reserved
 * 
 **************************************************************************/
/**
 * 
 * @file PushException.php
 * @encoding UTF-8
 * 
 * @date 2014年12月31日
 *
 */

namespace App\Http\Controllers\Push;


/**
 * 表示一个服务端API调用异常,接收到这个异常一般表示客户端及网络运行正常
 */
class ServerException extends \Exception {
    /**
     * Constructor
     * @param string $msg
     * @param int $code
     */
    function __construct($msg, $code) {
        parent::__construct($msg, $code);
    }
}




