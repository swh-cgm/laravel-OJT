<?php
namespace App\Contracts\Dao;

use Illuminate\Http\Request;
use App\Models\User;

interface UserDaoInterface
{
    public function insert(array $insertData);

    public function getUserById(int $id);

    public function delete(User $user);

    public function update(array $updateData, int $id);

    public function getAllUser();

    public function storeChangedPassword(Request $request, User $auth);

    public function storeResetPassword(Request $request);
}
