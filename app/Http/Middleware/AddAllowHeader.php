<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddAllowHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Retrieve the route's allowed methods
        $allowedMethods = $request->route()->methods();

        $response->headers->add(['Allow' => implode(', ', $allowedMethods)]);

        return $response;
    }
}
