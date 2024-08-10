<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = session('user_id');
        $role    = [];
        $user    = User::where('id', $user_id)
            ->has('userRole')
            ->first();

        if ($user_id && $user) {
            foreach ($user->userRole as $ur) {
                $role[] = $ur->role_id;
            }

            session([
                'user_id'           => $user->id,
                'user_name'         => $user->name,
                'user_email'        => $user->email,
                'user_role'         => $role
            ]);

            return $next($request);
        } else {
            session()->flush();
            return redirect('/');
        }
    }
}
