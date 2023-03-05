<?php

namespace App\Http\Controllers\v1;

use App\Common\Response\RespResult;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return RespResult::success();
    }
}