<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Log;

class StartMonitor
{
    public function handle(Request $request, Closure $next)
    {
        $this->writeRequestLog($request);
        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        $this->writeResponseLog($request, $response);
    }

    public function writeRequestLog(Request $request)
    {
        $data = [
            'path' => $request->path(),
            'method' => $request->method(),
            'user_agent' => $request->userAgent(),
            'params' => $request->all(),
            'request_id' => $request->headers->get("X-Request-ID"),
        ];
        Log::info("route start", $data);
    }

    public function writeResponseLog(Request $request, $response)
    {
        $costTime = round((microtime(true) - LARAVEL_START)*1000, 2);
        $data = [
            'path' => $request->path(),
            'response_body' => $response->getContent(),
            'response_time' => $costTime,
            'request_id' => $request->headers->get("X-Request-ID"),
        ];
        Log::info("route end", $data);
    }
}
