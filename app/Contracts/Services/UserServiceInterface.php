<?php
namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function insert(Request $request);
    public function getUserById($id);

    public function delete($id);

    public function update(Request $request);

    public function getAllUser();
}
?>
