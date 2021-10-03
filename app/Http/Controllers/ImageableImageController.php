<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UserResource;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Exception;

class ImageableImageController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(int $id)
    {
        $imageable = Image::find($id)->imageable;
        $imageableClass = get_class($imageable);

        switch ($imageableClass) {
            case  User::class:
                return new UserResource($imageable);
            case  Post::class:
                return new PostResource($imageable);
            default:
                throw new Exception('not found the imageableClass');
        }
    }
}
