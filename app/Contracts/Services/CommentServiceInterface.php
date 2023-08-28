<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

interface CommentServiceInterface{
    public function getCommentByPostId(Request $request);

    public function insert(StoreCommentRequest $request);

    public function delete();

    public function update();
}