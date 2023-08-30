<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AdminServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Exports\CommentsExport;
use App\Exports\PostsExport;
use App\Exports\UsersExport;
use App\Http\Requests\AdminPasswordStoreRequest;
use App\Http\Requests\CsvUploadRequest;
use App\Imports\PostsImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    protected $postService;
    protected $userService;
    protected $adminService;
    public function __construct(PostServiceInterface $postService, UserServiceInterface $userService, AdminServiceInterface $adminService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
        $this->adminService = $adminService;
    }

    /**
     * Edit post
     *
     * @param integer $id
     * @return View
     */
    public function editPost(int $id): View
    {
        $data = $this->postService->getPostById($id);
        return view('posts.edit', ['post' => $data, 'updated_by' => Auth::user()->id]);
    }
    /**
     * Edit user
     *
     * @param integer $id
     * @return View
     */
    public function editUser(int $id): View
    {
        $post = $this->userService->getUserById($id);
        return view('admin.editUserProfile', ['user' => $post]);
    }

    /**
     * Update user store
     *
     * @param AdminPasswordStoreRequest $request
     * @return void
     */
    public function updateUser(AdminPasswordStoreRequest $request): RedirectResponse
    {
        $this->adminService->updateUser($request);

        if ($request->new_password != null) {
            $this->adminService->storeChangePassword($request->new_password, $request->id);
        }
        return back();
    }

    public function csvShow()
    {
        return view('admin.file');
    }

    public function postCsvDownload()
    {
        return $this->adminService->postCsvDownload();
    }

    public function postCsvUpload(CsvUploadRequest $request)
    {
        $failures = $this->adminService->postCsvUpload($request);

        return back()->with('failures', $failures);
    }
}
