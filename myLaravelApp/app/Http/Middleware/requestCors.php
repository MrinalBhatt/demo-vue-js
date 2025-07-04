<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class requestCors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         Log::info('🔥 requestCors is running on: ' . $request->getMethod() . ' ' . $request->path());
         $headers = [
            "Access-Control-Allow-Origin" => "http://localhost:5173",
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization'
        ];
        if ($request->getMethod() == "OPTIONS") {
            return response('OK')
                ->withHeaders($headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value){
            $response->header($key, $value);
        }
        Log::info($response);

        return $response;
    }
}
