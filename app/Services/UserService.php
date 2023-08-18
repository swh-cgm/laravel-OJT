<?php 
namespace App\Services;

use App\Models\User;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface{
    protected $userDao;

    public function __construct(UserDaoInterface $userDaoInterface){
        $this->userDao = $userDaoInterface;
    }

    public function insert($request){
        $encrypted = Hash::make($request->password);
        
        // $path = $request->file('img')->store('pfp');

        $filename = $request->img->getClientOriginalName();
        $request->img->storeAs('UserImages',$filename,'public');

        $insertData = [
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>$encrypted,
            'role'=>$request->role,
            'img'=>$filename,
            'created_by'=>1
        ];

        return $this->userDao->insert($insertData);
    }

    public function getUserById($id){
        $data = $this->userDao->getUserById($id);
        return $data;
    }
}

?>