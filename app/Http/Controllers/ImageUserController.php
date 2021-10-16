<?php

namespace App\Http\Controllers;

use App\Http\Resources\Image\ImageResource;
use App\Models\User;

class ImageUserController extends Controller
{
    public function __invoke(int $id): ImageResource
    {
        return new ImageResource(User::find($id)->images);
    }
}
