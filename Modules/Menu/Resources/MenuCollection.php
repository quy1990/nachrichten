<?php

namespace Modules\Menu\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data'  => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
