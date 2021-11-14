<?php

namespace App\Http\Services;

use App\Http\Resources\User\UserResource;
use Exception;
use Modules\Category\Entities\Image;
use Modules\Category\Entities\Post;
use Modules\User\Entities\User;
use Modules\Post\Resources\PostResource;

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
