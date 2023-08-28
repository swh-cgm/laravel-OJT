<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Contracts\Dao\CommentDaoInterface;
use App\Contracts\Services\CommentServiceInterface;
use App\Http\Requests\StoreCommentRequest;

class CommentService implements CommentServiceInterface{

    protected $commentDao;
    public function __construct(CommentDaoInterface $commentDao){
        $this->commentDao = $commentDao;
    }

    public function getCommentByPostId(Request $request){
        return $this->commentDao->getCommentByPostId($request->post_id);
    }

    public function insert(StoreCommentRequest $request){
        $insertArray = [
            'comment' => $request->user_comment,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];
        $this->commentDao->insert($insertArray);
    }

    public function delete(){
        //
    }

    public function update(){
        //
    }

}