<?php
namespace App\Services;

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
     * @return void
     */
    public function insert(Request $request): void
    {
        $encrypted = Hash::make($request->password);

        if ($request->img) {
            $filename = $request->img->getClientOriginalName();
            $request->img->storeAs('UserImages', $filename, 'public');
        } else {
            $filename = "default.png";
        }

        $insertData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encrypted,
            'role' => $request->has('role')? $request->role : '2',
            'img' => $filename,
            'created_by' => 1
        ];
        $this->userDao->insert($insertData);
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
     * @return void
     */
    public function delete(int $id): void
    {
        $this->userDao->delete($id);
    }

    /**
     * update user
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        if ($request->img) {
            $filename = $request->img->getClientOriginalName();
            $request->img->storeAs('UserImages', $filename, 'public');
        } else {
            $filename = User::where('id', $request->id)->value('img');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->has('role')? $request->role : '2',
            'img' => $filename,
            'created_by' => 1
        ];
        $this->userDao->update($updateData, $request->id);
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

    public function verifyUserExists(Request $request): bool
    {
        return $this->userDao->verifyUserExists($request);
    }
}
