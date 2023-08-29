<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CommentServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    protected $commentService;

    public function __construct(UserServiceInterface $userService, CommentServiceInterface $commentService)
    {
        $this->userService = $userService;
        $this->commentService = $commentService;
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
        if (Auth::check()) {
            if (Auth::user()->role == config('constants.user_role.admin_no')) {
                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:8|max:255',
                    'password_confirmation' => 'required|min:8|max:255',
                    'img' => 'image',
                    'role' => 'required'
                ]);
            }
        } else {

            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:8|max:255',
                'password_confirmation' => 'required|min:8|max:255',
                'img' => 'image',
            ]);
        }

        $this->userService->insert($request);
        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    /**
     * show user detail
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        $data = $this->userService->getUserById($id);
        $comments = $this->commentService->getCommentByUserId($id);
        if ($data != null) {
            return view('users.detail', ['user' => $data, 'comments' => $comments]);
        } else {
            return redirect()->route('users.index')->with('failed', 'User Does Not Exist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->userService->getUserById($id);
        return view('users.edit', ['user' => $data]);
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
        if (Auth::check()) {
            if (Auth::user()->role == config('constants.user_role.admin_no')) {
                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'img' => 'image',
                    'role' => 'required'
                ]);
            }
        } else {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'img' => 'image',
            ]);
        }
        $this->userService->update($request);
        return back()->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     *
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        $this->userService->delete($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
