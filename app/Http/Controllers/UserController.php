<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->get();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|min:8|max:255',
            'img' => 'required|image',
            'role' => 'required'
        ]);
        
        $data = $this->userService->insert($request); 
        return redirect('index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->userService->getUserById($id);
        if($data!=null){
            return view('users.detail', ['user' => $data]);
        }
        else{
            return redirect('index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


}
