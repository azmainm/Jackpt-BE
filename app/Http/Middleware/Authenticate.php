<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     *
     * @throws \Exception
     */
    protected function redirectTo($request)
    {
        if (! $request->bearerToken()) {
            return throw new \Exception('Please provide Token', 401);
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
