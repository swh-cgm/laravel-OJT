<?php

namespace App\Contracts\Services;

use App\Http\Requests\StoreCommentRequest;

interface CommentServiceInterface{
    public function getCommentByPostId();

    public function insert(StoreCommentRequest $request);

    public function delete();

    public function update();
}