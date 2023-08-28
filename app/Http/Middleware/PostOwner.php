<?php

namespace App\Http\Middleware;

use App\Contracts\Services\PostServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostOwner
{
    protected $postService;
    function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect()->route('loginScreen');
        } else {
            $user = Auth::user();
            $post = $this->postService->getPostById($request->id);

            if ($user->role == config('constants.user_role.admin_no')) {
                return $next($request);
            } else {
                if ($post->created_by == $user->id) {
                    return $next($request);
                } else {
                    return back()->withErrors('You can only modify your own posts.');
                }
            }
        }
    }
}
