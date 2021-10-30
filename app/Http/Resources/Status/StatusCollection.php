<?php

namespace App\Http\Resources\Status;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StatusCollection extends ResourceCollection
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
