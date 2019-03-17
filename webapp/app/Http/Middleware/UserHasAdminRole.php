<?php

namespace App\Http\Middleware;

use App\Interfaces\IUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserHasAdminRole
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
        $user = Auth::user();

        if (! $user instanceof IUser) {
            return redirect(route('login'));

        }

        if (! $user->hasRole(IUser::ROLE_ADMIN)) {
            return redirect(route('home'))
                    ->withErrors('No tienes permisos para acceder a esta sección');
        }

        return $next($request);
    }
}
