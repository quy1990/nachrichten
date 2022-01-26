<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'post_count' => $this->posts_count
        ];
    }
}
