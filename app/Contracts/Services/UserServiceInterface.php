<?php
namespace App\Contracts\Services;

interface UserServiceInterface{
    public function insert(Request $request);
    public function getUserById($id);
}
?>