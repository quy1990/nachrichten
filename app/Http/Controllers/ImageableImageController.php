<?php

namespace App\Http\Controllers;

use App\Http\Services\ImageableImageService;
use App\Models\Image;
use Exception;

class ImageableImageController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(Image $image)
    {
        try {
            /** @var ImageableImageService $imageableImageService */
            $imageableImageService = app(ImageableImageService::class);
            return $imageableImageService->getImageable($image);
        } catch (Exception $e) {
            return response('there is Error', 400);
        }
    }
}
