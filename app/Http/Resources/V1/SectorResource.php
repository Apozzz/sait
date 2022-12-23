<?php

namespace App\Http\Resources\V1;

use App\Models\Sector;
use Illuminate\Http\Resources\Json\JsonResource;

class SectorResource extends JsonResource
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
          'code' => $this->code,
          'marketId' => $this->market_id,
          'rooms' => Sector::first()->sectorRooms($this->id)->toArray(),
        ];
    }
}
