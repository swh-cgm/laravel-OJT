<?php

namespace App\Dao;
use App\Contracts\Dao\CommentDaoInterface;
use App\Models\Comment;
use Ramsey\Collection\Collection;

class CommentDao implements CommentDaoInterface{
    public function getCommentByPostId()
    {
        //
    }
    public function insert(array $insertData){
        Comment::create($insertData);
    }

    public function delete(){
        //
    }

    public function update(){
        //
    }
}