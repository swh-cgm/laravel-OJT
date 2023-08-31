<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AdminServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\AdminFormRequest;
use App\Http\Requests\AdminPasswordStoreRequest;
use App\Http\Requests\CsvUploadRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
     * Show admin index
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.index');
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

    /**
     * Show blade for downloading/uploading csv files
     *
     * @return void
     */
    public function csvShow(): View
    {
        return view('admin.file');
    }

    /**
     * Download posts table as csv file
     *
     * @return BinaryFileResponse
     */
    public function postCsvDownload(): BinaryFileResponse
    {
        return $this->adminService->postCsvDownload();
    }

    /**
     * Insert uploaded csv in post table and return rows that cannot be inserted.
     *
     * @param CsvUploadRequest $request
     * @return RedirectResponse
     */
    public function postCsvUpload(CsvUploadRequest $request): RedirectResponse
    {
        $failures = $this->adminService->postCsvUpload($request);

        return back()->with('failures', $failures);
    }

    /**
     * Show form for editing user info
     *
     * @param AdminFormRequest $request
     * @return RedirectResponse
     */
    public function editUserForm(AdminFormRequest $request): RedirectResponse
    {
        return redirect()->route('admin.edit.users', $request->id);
    }

    /**
     * Show form for editing post 
     *
     * @param AdminFormRequest $request
     * @return RedirectResponse
     */
    public function editPostForm(AdminFormRequest $request): RedirectResponse
    {
        return redirect()->route('admin.edit.posts', $request->id);
    }
}
