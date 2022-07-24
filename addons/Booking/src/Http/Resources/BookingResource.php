<?php

namespace Addons\Booking\Http\Resources;

use Fusion\Http\Resources\EntryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'starts_at' => $this->resource->starts_at,
            'ends_at' => $this->resource->ends_at,
            'display_starts_at' => $this->resource->starts_at->toDateTimeString(),
            'display_ends_at' => $this->resource->ends_at->toDateTimeString(),
            'bookable' => new BookableResource($this->resource->bookable),
            'detail' => new EntryResource($this->resource->detail),
        ];
    }
}