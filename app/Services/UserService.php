<?php
namespace App\Services;

use App\Dao\UserDao;
use App\Models\User;
use Illuminate\Http\Request;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $userDao;

    public function __construct(UserDaoInterface $userDaoInterface)
    {
        $this->userDao = $userDaoInterface;
    }

    /**
     * insert user
     *
     * @param Request $request
     * @return null
     */
    public function insert(Request $request): null
    {
        $encrypted = Hash::make($request->password);

        // $path = $request->file('img')->store('pfp');

        $filename = $request->img->getClientOriginalName();
        $request->img->storeAs('UserImages', $filename, 'public');

        $insertData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encrypted,
            'role' => $request->role,
            'img' => $filename,
            'created_by' => 1
        ];

        return $this->userDao->insert($insertData);
    }

    /**
     * get user by Id
     *
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        $data = $this->userDao->getUserById($id);
        return $data;
    }

    /**
     * Delete user
     *
     * @param int $id
     * @return null
     */
    public function delete(int $id): null
    {
        return $this->userDao->delete($id);
    }

    /**
     * update user
     *
     * @param Request $request
     * @return null
     */
    public function update(Request $request): null
    {
        if ($request->img) {
            $filename = $request->img->getClientOriginalName();
            $request->img->storeAs('UserImages', $filename, 'public');
        } else {
            $filename = null;
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'img' => $filename,
            'created_by' => 1
        ];

        return $this->userDao->update($updateData, $request->id);
    }

    /**
     * Get all user
     *
     * @return Collection
     */
    public function getAllUser(): Collection
    {
        return $this->userDao->getAllUser();
    }
}
