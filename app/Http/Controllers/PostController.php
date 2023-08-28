<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;


class PostController extends Controller
{
    protected $postService;
    protected $userService;
    public function __construct(PostServiceInterface $postService, UserServiceInterface $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = $this->postService->getAllPost();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create(): mixed
    {
        return view('posts.create', ['user_id' => Auth::user()->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $post_id = $this->postService->insert($request);

        return redirect()->route('posts.show', [$post_id])->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $post = $this->postService->getPostById($id);
        $originalPoster = $this->userService->getUserById($post->created_by);
        return view('posts.post', ['post' => $post, 'originalPoster' => $originalPoster]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $post = $this->postService->getPostById($id);
        return view('posts.edit', ['post' => $post, 'updated_by' => Auth::user()->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->postService->update($request);
        return redirect()->route('posts.index')->with(['success', 'Post updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->postService->delete($id);
        return redirect()->route('posts.index')->with(['success', 'Post deleted successfully.']);
    }
}
