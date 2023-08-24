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
        if(Auth::check()){
            $posts = $this->postService->getAllPost();
        }
        else{
            $posts = $this->postService->getPublicPost();
        }
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
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $post = $this->postService->getPostById($id);
        $originalPoster = $this->userService->getUserById($post->created_by);
        $postOwner = false;
        if(Auth::check()){
            $auth_user = Auth::user()->id;
            $postOwner = $auth_user==$post->created_by? true: false;
        }

        return view('posts.post', ['post' => $post, 'originalPoster' => $originalPoster, 'postOwner'=>$postOwner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit(int $id): mixed
    {
        if (Auth::check()) {
            $post = $this->postService->getPostById($id);
            if ($post->created_by == Auth::user()->id) {
                
                return view('posts.edit', ['post' => $post, 'updated_by' => Auth::user()->id]);
            } else {
                return redirect()->route('posts.index')->with('error', 'You can only edit your own posts.');
            }
        } else {
            return redirect()->route('posts.index')->with('error', 'Must be logged in to edit a post.');
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
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        if (Auth::check()) {
            $post = $this->postService->getPostById($id);
            if ($post->created_by == Auth::user()->id) {
                $this->postService->delete($id);
                return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
            } else {
                return redirect()->route('posts.index')->with('error', 'You can only delete your own posts.');
            }
        } else {
            return redirect()->route('posts.index')->with('error', 'Must be logged in to delete a post.');
        }
    }
}
