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
            'status'          => $this->getStatusArray(),
            'image'           => $this->image,
            'subscribe_count' => $this->subscribers()->count(),
            'created_at'      => $this->created_at->diffForHumans(),
            'updated_at'      => $this->updated_at->diffForHumans(),
        ];
    }

    private function getAuthorArray(): array
    {
        return [
            'user_id'   => $this->user->id,
            'user_name' => $this->user->name
        ];
    }

    private function getCategoryArray(): array
    {
        return [
            'category_id'   => $this->category->id,
            'category_name' => $this->category->name
        ];
    }


    private function getStatusArray(): array
    {
        return [
            'status_id'   => $this->status->id,
            'status_name' => $this->status->name
        ];
    }
}
