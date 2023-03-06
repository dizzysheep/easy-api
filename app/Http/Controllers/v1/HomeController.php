<?php

namespace App\Http\Controllers\v1;

use App\Common\Response\RespResult;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return RespResult::success();
    }

    /**
     * @desc 发生普通文本信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function send()
    {
        Mail::raw('自如初-测试邮件发送' , function(Message $message){
            // 邮件接收者
            $message->to(env('TEST_MAIL_USERNAME'));
            // 邮件主题
            $message->subject('大笨蛋，收到没！！！');
        });
        return RespResult::success();
    }

    // 发送富文本邮件
    public function beauty()
    {
        /**
         * send(参数1，参数2)
         *
         * 参数1：视图
         * 参数2：要传递给视图的数据信息
         */
        Mail::send('mail.beauty',['msg'=>'自如初个人博客，一个记录生活与学习的博客'],function(Message $message){
            // 发给谁
            $message->to(env('TEST_MAIL_USERNAME'));
            // 发送的主题
            $message->subject('hello world');
        });
        return RespResult::success();
    }

}