<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenCan
{
    /**
     * Middleware to check tokens capacity before executing controllers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $access): Response
    {
        if (false === $request->user()->tokenCan($access)) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
        return $next($request);
    }
}
