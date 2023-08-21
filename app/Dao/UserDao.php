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
     * @param array $insertData
     * @return void
     */
    public function insert(array $insertData): void
    {
        User::create($insertData);
    }

    /**
     * Get Users By Id
     *
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        $data = User::find($id);
        return $data;
    }

    /**
     * Delete User
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        User::whereId($id)->delete();
    }

    /**
     * Update User
     *
     * @param array $updateData
     * @param integer $id
     * @return void
     */
    public function update(array $updateData, int $id): void
    {
        User::where('id', $id)->update($updateData);
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
