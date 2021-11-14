<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Resources\Tag\TagCollection;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
use Modules\Category\Entities\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Tag::class, 'tag');
    }

    public function index(): TagCollection
    {
        return new TagCollection(Tag::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagStoreRequest $request
     * @return TagResource
     */
    public function store(TagStoreRequest $request): TagResource
    {
        $tag = new Tag();
        $tag->name = $request->get('name');
        $tag->save();
        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return TagResource
     */
    public function show(Tag $tag): TagResource
    {
        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagUpdateRequest $request
     * @param Tag $tag
     * @return TagResource
     */
    public function update(TagUpdateRequest $request, Tag $tag): TagResource
    {
        $tag->update($request->all());
        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return Response
     */
    public function destroy(Tag $tag): Response
    {
        $tag->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
