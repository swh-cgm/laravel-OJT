<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Index function
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->userService->getAllUser();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|min:8|max:255',
            'img' => 'image',
            'role' => 'required'
        ]);

        $this->userService->insert($request);
        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    /**
     * show user detail
     *
     * @param User $user
     * @return mixed
     */
    public function show(User $user): view
    {
        return view('users.detail', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'img' => 'image',
            'role' => 'required'
        ]);
        $this->userService->update($request);
        return back()->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->userService->delete($user);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
