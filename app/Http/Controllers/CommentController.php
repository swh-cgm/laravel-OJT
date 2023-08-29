<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CommentServiceInterface;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentServiceInterface $commentService){
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return string
     */
    public function store(StoreCommentRequest $request): string
    {
        return $this->commentService->insert($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCommentRequest $request
     * @param Comment $comment
     * @return string
     */
    public function update(StoreCommentRequest $request, Comment $comment): string
    {
        return $this->commentService->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->commentService->delete($id);
        return back();
    }
}
