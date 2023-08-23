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
        if (Auth::check() && Auth::user()) {
            return view('posts.create', ['user_id' => Auth::user()->id]);
        } else {
            return redirect()->route('posts.index')->with('error', 'Must be logged into create posts.');
        }
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
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        $originalPoster = $this->userService->getUserById($post->created_by);
        return view('posts.post', ['post' => $post, 'originalPoster' => $originalPoster]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return mixed
     */
    public function edit(Post $post): mixed
    {

        if (Auth::check()) {
            return view('posts.edit', ['post' => $post, 'updated_by' => Auth::user()->id]);
        } else {
            return back()->withErrors('Must be logged in to edit a post.');
        }
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
        return redirect()->route('posts.index')->with(['success', 'post update success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        if (Auth::check()) {
            $this->postService->delete($post);
            return redirect()->route('posts.index');
        } else {
            return back()->withErrors('Must be logged in to delete a post.');
        }
    }
}
