<?php

namespace App\Http\Controllers;

use App\Http\Resources\Image\ImageCollection;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ImageCollection
     */
    public function index(): ImageCollection
    {
        return new ImageCollection(Image::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ImageResource
     */
    public function store(Request $request): ImageResource
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
     * @param Request $request
     * @param Image $image
     * @return ImageResource
     */
    public function update(Request $request, Image $image): ImageResource
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
