<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function App\Helpers\getIp;

class IpWhitelistMiddleware
{
    /**
     * @return mixed
     *
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        $redis = Redis::connection();
        $redis->set('WHITELISTED_IPS', json_encode(['172.17.0.2', '172.17.0.3']));
        if ((config('app.env') == 'local') || ($redis->exists(config('vutal.whitelisted_ip_redis_key_name')) &&
                in_array(getIp(), json_decode($redis->get(config('vutal.whitelisted_ip_redis_key_name')))))) {
            return $next($request);
        }
        throw new AuthorizationException;
    }
}
