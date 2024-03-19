<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado == 0) {
            Auth::logout(); // Desconectamos al usuario si el estado es 0
            notify()->error('Tu cuenta está deshabilitada. Contacta con el Coordinador.');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
