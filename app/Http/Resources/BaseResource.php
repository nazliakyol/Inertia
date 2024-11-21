<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public function only(...$attributes)
    {
        //one way to do that:
        //        return collect($this->resolve())
        //                ->only($attributes)
        //                ->toArray();

        //another way to do that:
        //        return Arr::only($this->resolve(), $attributes);

        return $this->only($attributes);
    }
}
