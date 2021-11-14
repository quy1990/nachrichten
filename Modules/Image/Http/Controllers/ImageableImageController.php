<?php

namespace Modules\Image\Http\Controllers;

use App\Http\Services\ImageableImageService;
use Exception;
use Modules\User\Http\Controllers\Controller;

class ImageableImageController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(int $imageId)
    {
        try {
            /** @var ImageableImageService $imageableImageService */
            $imageableImageService = app(ImageableImageService::class);
            return $imageableImageService->getImageable($imageId);
        } catch (Exception $e) {
            return response('there is Error', 400);
        }
    }
}
