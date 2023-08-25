<?php
namespace App\Contracts\Services;

use App\Http\Requests\AdminPasswordStoreRequest;
interface AdminServiceInterface
{
    public function storeChangePassword(string $password, int $id);

    public function updateUser(AdminPasswordStoreRequest $request);
}
