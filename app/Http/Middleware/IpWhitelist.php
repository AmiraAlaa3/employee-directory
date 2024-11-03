<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpWhitelist
{
    protected $whitelist = [
        '123.456.789.000',
        '111.222.333.444',
    ];


    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->ip(), $this->whitelist)) {
            return response()->json(['message' => 'Your IP address is not authorized.'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}


