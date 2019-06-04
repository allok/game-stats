<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\IpUtils;

class TrustIp
{
    protected $trust = [
        '192.168.1.0/24',
        '192.168.10.0/24',
        '127.0.0.1',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->isFromTrustedIp($request)) {
            return abort(403, __('access.forbidden'));
        }

        return $next($request);
    }

    /**
     * Indicates whether this request originated from a trusted ip.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool true if the request came from a trusted ip, false otherwise
     */
    public function isFromTrustedIp($request): bool
    {
        return !$this->trust || IpUtils::checkIp($request->ip(), $this->trust);
    }
}
