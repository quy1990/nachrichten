<?php

namespace App\Http\Resources\Menu;

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
