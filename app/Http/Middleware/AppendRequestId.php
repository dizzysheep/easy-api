<?php

namespace App\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class AppendRequestId
{
    /**
     * @desc 向response添加X-Request-ID
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|Response
     */
    public function handle(Request $request, Closure $next)
    {
        $requestId = Uuid::uuid6()->toString();

        $request->headers->set('X-Request-ID', $requestId);

        /** @var $response Response */
        $response = $next($request);

        $response->headers->set('X-Request-ID', $requestId);

        //返回Json格式添加request_id
        if ($response instanceof JsonResponse) {
            $response->setData(tap($response->getData(), function ($data) use ($requestId) {
                if (empty($data)) {
                    return;
                }
                if (is_object($data)) {
                    $data->request_id = $requestId;
                }
            }));
        }

        return $response;
    }
}
