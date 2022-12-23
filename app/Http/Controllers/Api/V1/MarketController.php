<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreMarketRequest;
use App\Http\Requests\V1\UpdateMarketRequest;
use App\Http\Resources\V1\MarketCollection;
use App\Http\Resources\V1\MarketResource;
use App\Models\Market;
use App\Service\AuthService;
use App\Service\MarketsService;
use Symfony\Component\HttpFoundation\Response;

class MarketController extends Controller
{
    private $authService;

    private $marketsService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->marketsService = new MarketsService();
    }

    public function index()
    {
        if ($this->authService->authorizeUser('GET')) {
            return new MarketCollection(Market::all());
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function show(Market $market)
    {
        if ($this->authService->authorizeUser('GET')) {
            return new MarketResource($market);
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function store(StoreMarketRequest $request)
    {
        if ($this->authService->authorizeUser('ASSIGN_SECTOR')) {
            return new MarketResource($this->marketsService->createMarket($request->toArray()));
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function update(UpdateMarketRequest $request, Market $market)
    {
        if ($this->authService->authorizeUser('ASSIGN_SECTOR')) {
            $this->marketsService->updateMarket($market, $request->all());

            return $market;
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function destroy(Market $market)
    {
        if ($this->authService->authorizeUser('ASSIGN_SECTOR')) {
            $this->marketsService->unsetMarketIdFromSectors($market->id);
            $market->delete();

            return new MarketCollection($market::all());
        }

        return $this->returnErrorCannotPerformAction();
    }

    private function returnErrorCannotPerformAction()
    {
        return response([
            'message' => 'You cannot perform this action!'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
