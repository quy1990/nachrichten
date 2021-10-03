<?php

namespace App\Http\Controllers;

use App\Http\Services\ImageableImageService;
use Exception;

class ImageableImageController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(int $id)
    {
        try {
            /** @var ImageableImageService $imageableImageService */
            $imageableImageService = app(ImageableImageService::class);
            return $imageableImageService->getImageable($id);
        } catch (Exception $e) {
            return response('there is Error', 404);
        }
    }
}
