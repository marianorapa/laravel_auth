<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckForPermission
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
        // Verifica si la ruta a la que quiere acceder el usuario
        // esta dentro de los permisos de los roles que posee.
        $user = Auth::user();

        if (! $user == null){
            $nombre_ruta = Route::currentRouteName();

            if ($user->hasPermiso($nombre_ruta)){
                return $next($request);
            }
        }

        return redirect(route('error.not_permission'));
    }
}
