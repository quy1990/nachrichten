<?php

namespace App\Http\Resources\Subscribe;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscribeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user' => $this->user_id,
            'subscribable' => $this->subscribable(),
        ];
    }
}
