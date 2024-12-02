<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek jika pengguna terautentikasi
        if (!Auth::check()) {
            return redirect('/'); // Atau halaman lain sesuai keinginan
        }

        // Cek apakah pengguna memiliki salah satu role yang dibutuhkan
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('/'); // Atau halaman lain sesuai keinginan
        }

        return $next($request);
    }
}
