<?php

namespace App\Contracts\Dao;

interface CommentDaoInterface{
    public function getCommentByPostId();

    public function insert(array $insertData);

    public function delete();

    public function update();
}

