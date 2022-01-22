<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
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
