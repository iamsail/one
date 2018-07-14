<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        $url = url()->current();
        $arr = explode('/', $url);
        $url = $arr[3];
        $power = $request->session()->get('power');
        $pos = strpos($url, $power);
        if ($pos !== 0) {
            return redirect('/stop');
        }
        return $next($request);
    }
}
