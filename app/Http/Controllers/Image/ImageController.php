<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Images\ImageStoreRequest;
use App\Http\Requests\Images\ImageUpdateRequest;
use App\Http\Resources\Image\ImageCollection;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Image::class, 'image');
    }

    public function index(): ImageCollection
    {
        return new ImageCollection(Image::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImageStoreRequest $request
     * @return ImageResource
     */
    public function store(ImageStoreRequest $request): ImageResource
    {
        $image = new Image();
        $image->url = $request->get('url');
        $image->imageable_id = $request->get('imageable_id');
        $image->imageable_type = $request->get('imageable_type');
        $image->save();
        return new ImageResource($image);
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return ImageResource
     */
    public function show(Image $image): ImageResource
    {
        return new ImageResource($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ImageUpdateRequest $request
     * @param Image $image
     * @return ImageResource
     */
    public function update(ImageUpdateRequest $request, Image $image): ImageResource
    {
        $image->update($request->all());
        return new ImageResource($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return Response
     */
    public function destroy(Image $image): Response
    {
        $image->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
