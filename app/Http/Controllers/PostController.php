<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class PostController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return PostCollection
     */
    public function index(): PostCollection
    {
        return new PostCollection(Post::with(['user', 'category'])->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return PostResource
     */
    public function store(PostStoreRequest $request): PostResource
    {
        $post = new Post();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->category_id = $request->get('category_id');
        $post->created_by = $request->get('created_by');
        $post->status_id = $request->get('status_id');
        $post->save();
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->all());
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post): Response
    {
        $post->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
