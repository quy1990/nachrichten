<?php

namespace App\Http\Services;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UserResource;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Exception;

class ImageableImageService
{
    /**
     * @throws Exception
     */
    public function getImageable(int $imageId)
    {
        $imageable = Image::findOrFail($imageId)->imageable;

        $imageableClass = get_class($imageable);

        switch ($imageableClass) {
            case  User::class:
                return new UserResource($imageable);
            case  Post::class:
                return new PostResource($imageable);
        }
    }
}
