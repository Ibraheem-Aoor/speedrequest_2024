<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VpnNotAllowedMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $query_params = [
            'key' => env('PROXY_CHECK_API_KEY'),
            'vpn' => 1,
        ];
        $proxey_check = Http::withoutVerifying()
            ->timeout(180)
            ->withHeaders(['Accept' => 'application/json'])
            ->get('https://proxycheck.io/v2/' . $ip, $query_params)->json();
        if (isset($proxey_check , $proxey_check[$ip]) && $proxey_check[$ip]['proxy'] == 'yes') {
            return abort(403);
        }
        return $next($request);
    }
}
