<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'space' => $this->space,
            'bookedFrom' => $this->booked_from ?? null,
            'bookedTo' => $this->booked_to ?? null,
            'sectorId' => $this->sector_id ?? null,
        ];
    }
}
