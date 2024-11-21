<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\stringStartsWith;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,

            // can set conditions for the fields
//          'email' => $this->mergeWhen($request->user()->is($this->resource), $this->email),

            'created_at' => $this->created_at,
            'can' => [
                'edit' => Auth::user()->can('edit', $this->resource),
//                'edit' => $request->user()->can('edit', $this->resource),
            ],
            'links' => [
                'edit' => route('users.edit', $this->resource),
                'show' => route('users.show', $this->resource),
            ],
            // also the relationships can be loaded here
//            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
