<?php

namespace App\Http\Resources\Subscribe;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SubscribeCollection extends ResourceCollection
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
