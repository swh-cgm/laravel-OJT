<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('loginScreen');
        } else {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return $next($request);
            } else {
                Log::info('user_id'.$user->id);
                Log::info('request_id'.$request->id);
                if ($user->id == $request->id) {
                    return $next($request);
                } else {
                    return back()->withErrors('You can only modify your own profile.');
                }
            }
        }
    }
}
