<?php
namespace App\Dao;

use App\Contracts\Dao\PostDaoInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Post;

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
        return DB::table("posts")->oldest('updated_at')->get();
    }

    /**
     * Get post by id
     *
     * @param integer $post_id
     * @return Post
     */
    public function getPostById(int $post_id): Post
    {
        return Post::find($post_id);
    }

    /**
     * Update post in database
     *
     * @param array $updateData
     * @param integer $post_id
     * @return void
     */
    public function update(array $updateData, int $post_id): void
    {
        Post::where('id', $post_id)->update($updateData);
    }

    /**
     * Delete post
     *
     * @param Post $post
     * @return void
     */
    public function delete(Post $post): void
    {
        $post->delete();
    }
}
