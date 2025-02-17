<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey || !User::where('api_key', $apiKey)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized - Invalid API Key',
            ], 401);
        }

        return $next($request);
    }
}
