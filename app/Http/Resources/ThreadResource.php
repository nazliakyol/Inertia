<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ThreadResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author->name,

            // Can be wrapped in a resource
            // 'author' => UserResource::make($this->author),
            'body' => $this->body,
            ];
    }
}
