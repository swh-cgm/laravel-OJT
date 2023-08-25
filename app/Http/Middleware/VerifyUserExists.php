<?php

namespace App\Http\Middleware;

use App\Contracts\Services\UserServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserExists
{
    protected $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->userService->verifyUserExists($request)){
            return $next($request);
        }
        else{
            return redirect()->route('posts.index')->withErrors('User does not exist.');
        }
        
    }
}
