<?php 
namespace App\Contracts\Dao;

interface UserDaoInterface{
    public function insert(Request $insertData);
    public function getUserById($id);
}
?>