<?php

namespace App\Dao;

use App\Contracts\Dao\CommentDaoInterface;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

class CommentDao implements CommentDaoInterface
{
    public function getCommentByPostId(int $postId): Collection
    {
        $comments = Post::find($postId)->comments;
        return $comments;
    }

    /**
     * Get comment by user id
     *
     * @param integer $userId
     * @return Collection
     */
    public function getCommentByUserId(int $userId): Collection
    {
        $user = User::find($userId);
        $comments = $user->comments()->get()->groupBy('post_id');
        return $comments;
    }

    /**
     * get comment by comment id
     *
     * @param integer $id
     * @return string
     */
    public function getCommentById(int $id): string
    {
        return Comment::where('id', $id)->first()->comment;
    }

    /**
     * Insert new comment into table
     *
     * @param array $insertData
     * @return Comment
     */
    public function insert(array $insertData): Comment
    {
        return Comment::create($insertData);
    }

    /**
     * Delete comment
     *
     * @param integer $id
    * @return void
     */
    public function delete(int $id): void
    {
        Comment::where('id', $id)->delete();
    }

    /**
     * Update comment
     *
     * @param integer $id
     * @param array $updateData
     * @return int
     */
    public function update(int $id, array $updateData): int
    {
        return Comment::where('id', $id)->update($updateData);
    }
}
