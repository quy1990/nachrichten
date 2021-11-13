<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'route' => $this->route,
            'icon'  => $this->icon
        ];
    }

    private function getImageable(): array
    {
        return [
            'imageable' => $this->imageable()
        ];
    }
}
