<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;
use App\Models\User;

class ImageUserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Image::class, 'image');
    }

    public function __invoke(int $id): ImageResource
    {
        return new ImageResource(User::find($id)->images);
    }
}
