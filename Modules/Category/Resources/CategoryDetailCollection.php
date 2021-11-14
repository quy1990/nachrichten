<?php

namespace Modules\Category\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryDetailCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
