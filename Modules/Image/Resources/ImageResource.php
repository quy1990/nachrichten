<?php

namespace Modules\Image\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'imageable' => $this->getImageable()
        ];
    }

    private function getImageable(): array
    {
        return [
            'imageable' => $this->imageable()
        ];
    }
}
