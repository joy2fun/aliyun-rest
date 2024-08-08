<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AliyunCredentialHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('x-aliyun-id')) {
            config([
                'filesystems.disks.aliyun.access_key' => $request->header('x-aliyun-id'),
            ]);
        }
        if ($request->hasHeader('x-aliyun-key')) {
            config([
                'filesystems.disks.aliyun.secret_key' => $request->header('x-aliyun-key'),
            ]);
        }
        return $next($request);
    }
}
