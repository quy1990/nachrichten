<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author_id' => $this->user ? $this->user->id : 0,
            'category_id' => $this->category ? $this->category->name : "no name",
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
