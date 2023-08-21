<?php
namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class UserDao implements UserDaoInterface
{
    /**
     * Insert Data
     *
     * @param [type] $insertData
     * @return void
     */
    public function insert($insertData): void
    {
        User::create($insertData);
    }

    /**
     * Get Users By Id
     *
     * @param [type] $id
     * @return User
     */
    public function getUserById($id): User
    {
        $data = User::find($id);
        return $data;
    }

    /**
     * Delete User
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id): void
    {
        User::whereId($id)->delete();
    }

    /**
     * Update User
     *
     * @param [type] $updateData
     * @param integer $id
     * @return void
     */
    public function update($updateData, int $id): void
    {
        $user = User::find($id);
        $user->name = $updateData['name'];
        $user->email = $updateData['email'];
        $user->role = $updateData['role'];
        if ($updateData['img']) {
            $user->img = $updateData['img'];
        }
        $user->save();
    }

    /**
     * Get All User
     *
     * @return Collection
     */
    public function getAllUser(): Collection
    {
        $users = DB::table('users')->oldest('updated_at')->get();
        return $users;
    }
}
