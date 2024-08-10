<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $idrole)
    {
        $role = session('user_role');

        $arrRole = explode('|', $idrole);

        $allow = false;

        foreach ($arrRole as $r) {
            if (in_array($r, $role)) {
                $allow = true;
            }
        }

        if ($allow) {
            return $next($request);
        } else {
            abort(401, 'This action is unauthorized.');
        }
    }
}
