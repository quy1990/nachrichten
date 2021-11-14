<?php

namespace Modules\Video\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
use Modules\Video\Entities\Video;
use Modules\Video\Http\Requests\VideoStoreRequest;
use Modules\Video\Http\Requests\VideoUpdateRequest;
use Modules\Video\Resources\VideoCollection;
use Modules\Video\Resources\VideoResource;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Video::class, 'video');
    }

    public function index(): VideoCollection
    {
        return new VideoCollection(Video::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VideoStoreRequest $request
     * @return VideoResource
     */
    public function store(VideoStoreRequest $request): VideoResource
    {
        $video = new Video();
        $video->video_path = $request->get('video_path');
        $video->title = $request->get('title');
        $video->body = $request->get('body');
        $video->user_id = $request->get('user_id');
        $video->category_id = $request->get('category_id');
        $video->save();
        return new VideoResource($video);
    }

    /**
     * Display the specified resource.
     *
     * @param Video $video
     * @return VideoResource
     */
    public function show(Video $video): VideoResource
    {
        return new VideoResource($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VideoUpdateRequest $request
     * @param Video $video
     * @return VideoResource
     */
    public function update(VideoUpdateRequest $request, Video $video): VideoResource
    {
        $video->update($request->all());
        return new VideoResource($video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Video $video
     * @return Response
     */
    public function destroy(Video $video): Response
    {
        $video->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
