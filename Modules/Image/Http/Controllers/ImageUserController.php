<?php

namespace Modules\Image\Http\Controllers;

use App\Http\Resources\Image\ImageResource;
use Modules\User\Entities\User;
use App\Http\Controllers\Controller;

;

class ImageUserController extends Controller
{
    public function __invoke(int $id): ImageResource
    {
        return new ImageResource(User::find($id)->images);
    }
}
