<?php

namespace Addons\Booking\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookableResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}