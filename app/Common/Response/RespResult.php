<?php

namespace App\Common\Response;

use App\Common\Constants\ErrorCode;

class RespResult
{
    /**
     * @desc 成功返回
     * @param array $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success(array $data = [], string $message = ""): \Illuminate\Http\JsonResponse
    {
        return self::result(ErrorCode::SUCCESS, $message, $data);
    }

    /**
     * @desc 失败返回
     * @param int $code
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error(int $code = ErrorCode::FAIL, string $message = "", array $data = []): \Illuminate\Http\JsonResponse
    {
        return self::result($code, $message, $data);
    }

    /**
     * @desc 通用返回
     * @param int $code
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function result(int $code, $message, array $data): \Illuminate\Http\JsonResponse
    {
        $message = $message ?: ErrorCode::getErrMessage($code);
        $data = ['code' => $code, "message" => $message, "data" => $data];
        return response()->json($data);
    }
}
