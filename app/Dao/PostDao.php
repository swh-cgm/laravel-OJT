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
        $data = DB::table('posts')
            ->join('users', 'posts.created_by', '=', 'users.id')
            ->select('*', 'posts.id as id')
            ->orderBy('posts.updated_at', 'DESC')
            ->get();

        return $data;
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
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Post::find($id)->delete();
    }

    public function getPublicPost(): collection
    {
        $data = DB::table('posts')
        ->join('users', 'posts.created_by', '=', 'users.id')
        ->select('*', 'posts.id as id')
        ->where('public_flag', true)
        ->orderBy('posts.updated_at', 'DESC')
        ->get();

        return $data;
    }
}
