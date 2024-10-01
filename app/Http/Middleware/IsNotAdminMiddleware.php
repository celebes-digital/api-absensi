<?php

namespace App\Http\Middleware;

use App\Constant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsNotAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->is_admin) {
            return response()->json([
                'status'    => 'error',
                'message'   => Constant::ERROR_MESSAGE_UNAUTHORIZED,
            ], 403);
        }

        return $next($request);
    }
}
