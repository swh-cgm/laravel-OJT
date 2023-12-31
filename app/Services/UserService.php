<?php
namespace App\Services;

use App\Models\User;
use Auth;
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

        if (Auth::check()) {
            if (Auth::user()->isAdmin())
                $created_by = Auth::user()->id;
        } else {
            $created_by = null;
        }

        $insertData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encrypted,
            'role' => $request->has('role')? $request->role : config('constants.user_role.member_no'),
            'img' => $filename,
            'created_by' => $created_by
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
            'role' => $request->has('role')? $request->role : config('constants.user_role.member_no'),
            'img' => $filename,
            'updated_by' => Auth::user()->id
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

    /**
     * Verify user exists in User table
     *
     * @param Request $request
     * @return boolean
     */
    public function verifyUserExists(Request $request): bool
    {
        return $this->userDao->verifyUserExists($request);
    }

    /**
     * Get Post by userId
     *
     * @param integer $userId
     * @return Collection
     */
    public function getPostByUserId(int $userId): Collection
    {
        return $this->userDao->getPostByUserId($userId);
    }
}
