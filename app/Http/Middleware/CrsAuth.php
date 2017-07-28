<?php

namespace App\Http\Middleware;

use Closure;
use App\Auth\AuthManager;

class CrsAuth
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

        $activeUser = (new authManager)->getLoggedInUser();

        // Save user's intended url in session to redirect after login
        session(['user_intended_url' => '/' . ltrim($request->path(), '/')]);

        if(empty($activeUser) OR !in_array(array_get($activeUser,'role'), AuthManager::$roles)) {
            return redirect('/login');
        }

        return $next($request);
    }
}
