<?php

namespace App\Contracts\Dao;

interface CommentDaoInterface{
    public function getCommentByPostId(int $post_id);

    public function insert(array $insertData);

    public function delete();

    public function update();
}

