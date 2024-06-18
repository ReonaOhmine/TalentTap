<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        // リクエストに基づいて適切なログインページにリダイレクト
        $route = $guards[0] === 'employer' ? 'employer.login' : 'agent.login';
        return redirect()->route($route);
    }
}
