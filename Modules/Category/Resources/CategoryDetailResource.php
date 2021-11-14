<?php

namespace Modules\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name . '(' . $this->posts_count . ')',
        ];
    }
}
