<?php
namespace App\Contracts\Dao;

use App\Models\Post;

interface PostDaoInterface
{
    public function insert(array $insertData);

    public function getAllPost();

    public function getPostById(int $post_id);

    public function update(array $updateData, int $post_id);

    public function delete(Post $post);
}
