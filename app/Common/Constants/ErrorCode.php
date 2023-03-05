<?php

namespace App\Common\Constants;

class ErrorCode
{
    //业务码
    //成功
    const SUCCESS = 0;

    //失败
    const FAIL = 1;

    //验证失败
    const VALID_FAIL = 2;

    //未找到
    const NOT_FOUND = 404;

    //无效token
    const VALID_ACCESS_TOKEN = 1001;


    /**
     * @desc 返回错误信息
     * @param $errCode
     * @return string
     */
    public static function getErrMessage($errCode): string
    {
        $errMsg = [
            self::SUCCESS => 'ok',
            self::FAIL => '系统错误',
            self::VALID_FAIL => '验证失败',
            self::NOT_FOUND => '未找到路由',
            self::VALID_ACCESS_TOKEN => '无效token',
        ];
        return $errMsg[$errCode] ?? "系统错误";
    }
}
