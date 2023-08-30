<?php
namespace App\Dao;

use App\Contracts\Dao\PostDaoInterface;
use Illuminate\Support\Collection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostDao implements PostDaoInterface
{
    /**
     * Create new post
     *
     * @param array $insertData
     * @return integer
     */
    public function insert(array $insertData): int
    {
        $post = Post::create($insertData);
        return $post->id;
    }

    /**
     * Get all posts
     *
     * @return Collection
     */
    public function getAllPost(): Collection
    {
        $userIds = User::select('id')->get()->pluck('id');
        $posts = Post::with('comments')->whereIn('created_by', $userIds)->get();
        return $posts;
    }

    /**
     * Get post by id
     *
     * @param integer $postId
     * @return Post
     */
    public function getPostById(int $postId): Post
    {
        return Post::with(['comments', 'comments.user'])->where('id', $postId)->first();
    }

    /**
     * Update post in database
     *
     * @param array $updateData
     * @param integer $postId
     * @return void
     */
    public function update(array $updateData, int $postId): void
    {
        Post::where('id', $postId)->update($updateData);
    }

    /**
     * Delete post
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Post::where('id', $id)->delete();
    }

    /**
     * get public posts
     *
     * @return collection
     */
    public function getPublicPost(): collection
    {
        $userIds = User::select('id')->get()->pluck('id');
        $posts = Post::with('comments')->whereIn('created_by', $userIds)->where('public_flag', true)->get();

        return $posts;
    }
    /**
     * Check if post exists
     *
     * @param Request $request
     * @return boolean
     */
    public function verifyPostExists(Request $request): bool
    {
        return Post::findOrFail($request->id) ? true : false;
    }
}
