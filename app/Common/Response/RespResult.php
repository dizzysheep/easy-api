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
    public static function success(array $data = [], string $message = "ok"): \Illuminate\Http\JsonResponse
    {
        $data = ['code' => ErrorCode::SUCCESS, "message" => $message, "data" => $data];
        return response()->json($data);
    }

    /**
     * @desc 失败返回
     * @param int $code
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error(int $code = ErrorCode::FAIL, string $message = "error", array $data = []): \Illuminate\Http\JsonResponse
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
        $data = ['code' => $code, "message" => $message, "data" => $data];
        return response()->json($data);
    }
}
