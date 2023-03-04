<?php

namespace App\Http\Controllers\v2;

use App\Common\Response\RespResult;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * @throws \Exception
     */
    public function except()
    {
        throw new \Exception("111", 222);
    }

    public function getRequestId(): \Illuminate\Http\JsonResponse
    {
        return RespResult::success(['id' => request()->headers->get("X-Request-ID")]);
    }
}
