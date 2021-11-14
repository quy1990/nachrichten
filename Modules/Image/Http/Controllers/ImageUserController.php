<?php

namespace Modules\Image\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Image\ImageResource;
use Modules\User\Entities\User;

class ImageUserController extends Controller
{
    public function __invoke(int $id): ImageResource
    {
        return new ImageResource(User::find($id)->images);
    }
}
