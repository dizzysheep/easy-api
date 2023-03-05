<?php

namespace App\Http\Controllers\v1;

use App\Common\Response\RespResult;
use App\Http\Controllers\Controller;
use App\Http\Model\User;

class UserController extends Controller
{
    public function list()
    {
        $data = [
          'total' => User::count(),
          'list' => User::all()->toArray(),
        ];
        return RespResult::success($data);
    }
}