<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class KeyAuth
{
    public function handle(Request $r, Closure $next)
    {
        return session()->has('priv') ? $next($r) : redirect('/admin/login');
    }
}
