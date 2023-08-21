<?php
namespace App\Contracts\Dao;

interface UserDaoInterface
{
    public function insert(array $insertData);
    public function getUserById(int $id);   
    public function delete(int $id);
    public function update(array $updateData, int $id);
    public function getAllUser();
}
