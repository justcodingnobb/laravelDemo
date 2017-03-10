<?php

return [

    /**
     * api 所指向的服务器地址.
     *
     * @var string
     */
    'host' => 'http://api.tuisong.baidu.com/rest/3.0/',

    // ios 开发状态1，生产状态2
    'deploy_status' => 1,

    /**
     * 开发者apikey, 由开发者中心(http://developer.baidu.com)获取, 
     * 当代码中未设置apikey时,使用此apikey
     * @var string
     */
    'default_apiKey' => '',
    'default_apiKey_pat' => '',
    
    /**
     * 开发者当前secretKey, 在应用重新生成secret key后, 旧的secret key将失效, 由开发者中心(http://developer.baidu.com)获取.
     * 当代码中未设置apikey时,使用此secretkey
     * @var string
     */
    'default_secretkey' => '',
    'default_secretkey_pat' => '',
    
    /**
     * 默认发送的devicetype
     *  
     * @var int | null
     */
    'default_devicetype' => 3,
    
    /**
     * 用于接收测试消息的channel_id.
     * 如果设置这一项内容, 每次执行test目录中的check_sdk_test.php时, 将向这个设备推送一条通知消息.用于确认SDK及环境功能正常.
     * 
     * @var string
     */
    'test_channel_id' => '',
    
    /**
     * log级别常量.
     * 
     * @var int
     */
    'LOG_LEVEL_DEV' => 0, // 开发状态, rd开发时使用, 最详细 log. 发布后被移除
    'LOG_LEVEL_TRACE' => 1, // 开发者开发时状态,隐藏rd开发时的细碎信息
    'LOG_LEVEL_ONLINE' => 2, // 开发者线上使用, 只有fault和warn
    'LOG_LEVEL_ONLINE_FAULT' => 3, // 开发者线上使用, 只有fault
    'LOG_LEVEL_ONLINE_SILENCE' => 4, // 静默.
    
    /**
     * 对log模块进行配置, 可选值为 [0 - 4], 参见上面的常量设置
     *
     * @var int
     */
    'LOG_LEVEL' => 0,
    
    /**
     * 输出位置.
     * page, 直接打印至页面.
     * stdout 打印至 php://stdout
     * {fpath} 打印至所指定的目标文件
     * 
     * @var string
     */
    'LOG_OUTPUT' => storage_path().'logs/push.log',
    
    /**
     * 异常控制方式.一个布尔值.
     * false 当出现异常将被抛出.
     * true 不抛出异常, 需通过 getErrorCode() 及 getErrorMessage() 进行获取.
     * 
     * @var boolean
     */
    'SUPPRESS_EXCPTION' => true,
    
    /**
     * 每次生成请求签名的失效时长.单位为秒, SIGN_EXPIRES <= 0 表示为由服务端自动处理.
     * default 0;
     *
     * @var int
     */
    'SIGN_EXPIRES' => 0,

];
