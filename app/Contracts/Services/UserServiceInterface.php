<?php
namespace App\Contracts\Services;

use Illuminate\Http\Request;
use App\Models\User;

interface UserServiceInterface
{
    public function insert(Request $request);

    public function getUserById(int $id);

    public function delete(User $user);

    public function update(Request $request);

    public function getAllUser();
}
