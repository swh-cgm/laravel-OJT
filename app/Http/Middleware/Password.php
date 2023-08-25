<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 
class Password
{
    /**
     * Handle an incoming request.
     *  
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            $user = Auth::user();
            if ($user->id == $request->id) {
                return $next($request);
            } else {
                return back()->withErrors('You can only modify your own profile.');
            }
        }
        return $next($request);
    }
}
