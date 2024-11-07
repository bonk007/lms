<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityRecording
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (($user = $request->user()) === null) {
            throw new AuthenticationException();
        }

        $user->activity()
            ->touch($request->url());

        return $next($request);
    }
}
