<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'body'            => $this->body,
            'author'          => $this->getAuthorArray(),
            'category'        => $this->getCategoryArray(),
            'image'           => $this->image,
            'status'          => $this->status->name,
            'subscribe_count' => $this->subscribers()->count(),
            'created_at'      => $this->created_at->diffForHumans(),
            'updated_at'      => $this->updated_at->diffForHumans(),
        ];
    }

    private function getAuthorArray(): array
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name
        ];
    }

    private function getCategoryArray(): array
    {
        return [
            'user_id' => $this->category->id,
            'user_name' => $this->category->name
        ];
    }
}
