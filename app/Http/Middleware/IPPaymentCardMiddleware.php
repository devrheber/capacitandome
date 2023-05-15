<?php

namespace App\Http\Middleware;

use Closure;
use Response;

class IPPaymentCardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $network = "194.50.38.0/24"; // add IP's by comma separated 127.0.0.1/24 - 200.123.228.82 - izipay 194.50.38.0/24
        $ip = request()->ip();
        $ip_arr = explode('/', $network);
        $network_long = ip2long($ip_arr[0]);

        $x = ip2long($ip_arr[1]);
        $mask =  long2ip($x) == $ip_arr[1] ? $x : 0xffffffff << (32 - $ip_arr[1]);
        $ip_long = ip2long($ip);

        // check ip is allowed
       if (($ip_long & $mask) != ($network_long & $mask)) {
                // return response
            return Response::json(['error' => 'Unauthenticated.'], 401);

        }    

        return $next($request);

    }
}
