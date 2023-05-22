<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PHPIniMiddleware
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        ini_set('precision', -1);
        ini_set('upload_max_filesize', '500M');
        ini_set('max_execution_time', 600);
        ini_set('post_max_size', '500M');

        return $next($request);
    }
}
