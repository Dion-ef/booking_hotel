<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next, $role)
    {
        $user = Auth::guard('admin')->user();

        if (!$user || $user->role !== $role) {
            return redirect('/login')->withErrors(['message' => 'Anda tidak memiliki akses ke halaman ini.']);
        }

        return $next($request);
    }
}
