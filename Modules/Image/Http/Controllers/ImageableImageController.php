<?php

namespace Modules\Image\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Modules\Image\Services\ImageableImageService;
use Modules\Post\Resources\PostResource;
use Modules\User\Resources\UserResource;

class ImageableImageController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(int $imageId): UserResource|Response|PostResource|Application|ResponseFactory
    {
        dd($imageId);
        try {
            /** @var ImageableImageService $imageableImageService */
            $imageableImageService = app(ImageableImageService::class);
            return $imageableImageService->getImageable($imageId);
        } catch (Exception $e) {
            return response('there is Error', 400);
        }
    }
}
