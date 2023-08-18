<?php 
namespace App\Dao;
use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;

class UserDao implements UserDaoInterface{
    public function insert($insertData){
        User::create($insertData);
    }
    public function getUserById($id){
        $data = User::find($id);
        return $data;
    }

}
?>