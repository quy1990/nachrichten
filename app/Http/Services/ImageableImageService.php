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
    public function getImageable(int $id)
    {
        $imageable = Image::findOrFail($id)->imageable;

        if (!is_null($imageable)) {
            $imageableClass = get_class($imageable);

            switch ($imageableClass) {
                case  User::class:
                    return new UserResource($imageable);
                case  Post::class:
                    return new PostResource($imageable);
            }
        }

        throw new Exception('Not found ImageableClass');
    }
}
