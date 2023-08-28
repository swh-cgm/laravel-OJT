<?php
namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Http\Requests\AdminPasswordStoreRequest;
use App\Models\User;


class AdminService implements AdminServiceInterface
{
    protected $userDao;

    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }
    /**
     * Store changed password by Admin
     *
     * @param string $password
     * @param integer $id
     * @return void
     */
    public function storeChangePassword(string $password, int $id): void
    {
        $this->userDao->storeChangedPassword($password, $id);
    }

    /**
     * Store changed user data by Admin
     *
     * @param AdminPasswordStoreRequest $request
     * @return void
     */
    public function updateUser(AdminPasswordStoreRequest $request): void
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
            'role' => $request->has('role') ? $request->role : '2',
            'img' => $filename,
            'created_by' => 1
        ];
        $this->userDao->update($updateData, $request->id);
    }
}
