<?php

namespace App\Http\Controllers\v1;

use App\Common\Response\RespResult;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
use Illuminate\Http\Request;

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

    public function detail(Request $request)
    {
        $data = $request->user()->toArray();
        return RespResult::success($data);
    }
}