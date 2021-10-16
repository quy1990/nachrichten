<?php

namespace App\Http\Controllers;

use App\Http\Resources\Image\ImageCollection;

class ImageUserController extends Controller
{
    public function __invoke(int $id): ImageCollection
    {
        return new ImageCollection(auth()->user()->images);
    }
}
