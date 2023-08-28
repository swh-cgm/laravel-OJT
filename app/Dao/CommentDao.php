<?php

namespace App\Dao;
use App\Contracts\Dao\CommentDaoInterface;
use App\Models\Comment;
use Illuminate\Support\Collection;

class CommentDao implements CommentDaoInterface{
    public function getCommentByPostId(int $post_id):Collection
    {
        return Comment::where('post_id', $post_id)->orderBy('updated_at', 'DESC')->get();
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