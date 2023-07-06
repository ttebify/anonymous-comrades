<?php

namespace App\Http\Middleware\Security;

use Closure;

class ContentSecurityPolicyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Add Content-Security-Policy header with a safe default policy
        $response->headers->add([
            'Content-Security-Policy' => "default-src 'self'; img-src 'self';",
        ]);

        return $response;
    }
}
