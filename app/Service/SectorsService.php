<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Market;
use App\Models\Room;
use App\Models\Sector;

class SectorsService
{
    public function createSector(array $data): void
    {
        $sector = new Sector();
        $sector->code = $data['code'];
        $sector->market_id = $data['market_id'] ?? null;
        $sector->timestamps = false;
        $sector->save();
    }

    public function updateSector(Sector $sector, array $data): void
    {
        $sector->code = $data['code'];
        $sector->market_id = Market::Find($data['market_id']) ? $data['market_id'] : $sector->market_id;
        $sector->timestamps = false;
        $sector->update();
    }

    public function unsetSectorIdFromRooms(int $sectorId): void
    {
        $rooms = Room::where('sector_id', $sectorId)->get();

        if (!$rooms) {return;}

        foreach ($rooms as $room) {
            $room->market_id = null;
            $room->update();
        }
    }
}
