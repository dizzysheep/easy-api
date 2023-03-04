<?php

namespace App\Http\Controllers\v1;

use App\Common\Constants\ErrorCode;
use App\Common\Response\RespResult;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AccessTokenController
{
    public function login(ServerRequestInterface $serverRequest)
    {
        $tokenResponse = parent::issueToken($serverRequest);
        if ($tokenResponse->getStatusCode() != 200) {
            return RespResult::error(ErrorCode::VALID_ACCESS_TOKEN, "获取token失败");
        }
        $data = json_decode($tokenResponse->getContent(), true);
        return RespResult::success($data);
    }
}
