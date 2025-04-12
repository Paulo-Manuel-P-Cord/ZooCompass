<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminPosition
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->position == 1) {
            return $next($request);
        }

        return redirect()->route('welcome');
    }
}



