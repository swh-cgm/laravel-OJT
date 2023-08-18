<?php
namespace App\Contracts\Dao;

use App\Models\User;

interface UserDaoInterface
{
    public function insert(Request $insertData);
    public function getUserById($id);
    public function delete($id);
    public function update(Request $updateData, int $id);
    public function getAllUser();
}

?>
