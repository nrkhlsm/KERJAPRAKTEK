<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user = User::with('model_has_role')->where('id', Auth::id())->first();

        if (!Auth::check() && $user->model_has_role->role_id == 1) {
            return redirect('');
        }
        return $next($request);
    }
}
