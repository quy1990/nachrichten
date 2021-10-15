<?php

namespace App\Http\Resources\Subscribe;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscribeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user'              => $this->user_id,
            'subscribable_id'   => $this->subscribable_id,
            'subscribable_type' => $this->subscribable_type,

        ];
    }
}
