<?php
namespace App\Contracts\Dao;

use App\Models\User;
use Illuminate\Http\Request;

interface UserDaoInterface
{
    public function insert(array $insertData);
    public function getUserById(int $id);   
    public function delete(int $id);
    public function update(array $updateData, int $id);
    public function getAllUser();
}
