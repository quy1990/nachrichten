<?php

namespace App\Http\Controllers;

use App\Http\Services\ImageableImageService;
use Exception;

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
