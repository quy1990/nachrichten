<?php

namespace Modules\Image\Services;

use Exception;
use Modules\Image\Entities\Image;
use Modules\Post\Entities\Post;
use Modules\Post\Resources\PostResource;
use Modules\User\Entities\User;
use Modules\User\Resources\UserResource;
use RuntimeException;

class ImageableImageService
{
    /**
     * @throws Exception
     */
    public function getImageable(int $imageId): UserResource|PostResource
    {
        $imageable = Image::findOrFail($imageId)->imageable;

        $imageableClass = get_class($imageable);

        switch ($imageableClass) {
            case  User::class:
                return new UserResource($imageable);
            case  Post::class:
                return new PostResource($imageable);
            default:
                throw new RuntimeException("Not found class");
        }
    }
}
