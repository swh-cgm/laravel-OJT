<?php
namespace App\Services;

use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Collection;

class PostService implements PostServiceInterface
{
    protected $postDao;

    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Store new post
     *
     * @param StorePostRequest $request
     * @return integer
     */
    public function insert(StorePostRequest $request): int
    {
        $insertData = [
            'title' => $request->title,
            'description' => $request->description,
            'public_flag' => $request->has('public_flag') ? true : false,
            'created_by' => $request->user_id
        ];
        return $this->postDao->insert($insertData);
    }

    /**
     * Get all posts
     *
     * @return collection
     */
    public function getAllPost(): collection
    {
        return $this->postDao->getAllPost();
    }

    /**
     * Get post by id
     *
     * @param integer $post_id
     * @return Post
     */
    public function getPostById(int $post_id): Post
    {
        return $this->postDao->getPostById($post_id);
    }

    /**
     * Update Post
     *
     * @param UpdatePostRequest $request
     * @return void
     */
    public function update(UpdatePostRequest $request): void
    {
        $post_id = $request->id;
        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'public_flag' => $request->has('public_flag') ? true : false,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by
        ];

        $this->postDao->update($updateData, $post_id);
    }

    /**
     * Delete post
     *
     * @param Post $post
     * @return void
     */
    public function delete(Post $post): void
    {
        $this->postDao->delete($post);
    }
}
