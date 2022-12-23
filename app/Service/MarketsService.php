<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Market;
use App\Models\Sector;

class MarketsService
{
    public function createMarket(array $data)
    {
        $market = new Market();
        $market->name = $data['name'];
        $market->address = $data['address'];
        $market->timestamps = false;
        $market->save();

        return $market;
    }

    public function updateMarket(Market $market, array $data)
    {
        $market->name = $data['name'];
        $market->address = $data['address'];
        $market->timestamps = false;
        $market->update();

        return $market;
    }

    public function unsetMarketIdFromSectors(int $marketId): void
    {
        $sectors = Sector::where('market_id', $marketId)->get();

        if (!$sectors) {return;}

        foreach ($sectors as $sector) {
            $sector->market_id = null;
            $sector->update();
        }
    }
}
