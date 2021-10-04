<?php

namespace App\Http\Controllers;

use App\Http\Resources\Video\VideoCollection;
use App\Http\Resources\Video\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

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
     * @param Request $request
     * @return VideoResource
     */
    public function store(Request $request): VideoResource
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
     * @param Request $request
     * @param Video $video
     * @return VideoResource
     */
    public function update(Request $request, Video $video): VideoResource
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
