<?php
namespace App\Contracts\Services;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

interface PostServiceInterface
{
    public function insert(StorePostRequest $request);

    public function getAllPost();

    public function getPostById(int $id);

    public function update(UpdatePostRequest $request);

    public function delete(Post $post);
}