<?php

namespace App\Http\Middleware;

use App\Contracts\Services\CommentServiceInterface;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentOwner
{
    protected $commentService;

    function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }
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
            $comment = $this->commentService->getCommentById($request->id);

            if ($user->isAdmin()) {
                return $next($request);
            } else {
                if ($comment->user_id == $user->id) {
                    return $next($request);
                } else {
                    return back()->withErrors('You can only modify your own comments.');
                }
            }
        }
    }
}
