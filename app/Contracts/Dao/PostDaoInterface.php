<?php
namespace App\Contracts\Dao;

interface PostDaoInterface
{
    public function insert(array $insertData);

    public function getAllPost();

    public function getPublicPost();

    public function getPostById(int $post_id);

    public function update(array $updateData, int $post_id);

    public function delete(int $id);
}
