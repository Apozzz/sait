<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\StoreSectorRequest;
use App\Http\Requests\V1\UpdateSectorRequest;
use App\Http\Resources\V1\SectorCollection;
use App\Http\Resources\V1\SectorResource;
use App\Models\Market;
use App\Models\Sector;
use App\Http\Controllers\Controller;
use App\Service\AuthService;
use App\Service\SectorsService;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class SectorController extends Controller
{
    private $authService;

    private $sectorsService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->sectorsService = new SectorsService();
    }

    public function index()
    {
        if ($this->authService->authorizeUser('GET')) {
            return new SectorCollection(Sector::all());/*Market::all()->toArray();*/
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function show(Sector $sector)
    {
        if ($this->authService->authorizeUser('GET')) {
            return new SectorResource($sector);
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function store(StoreSectorRequest $request)
    {
        if ($this->authService->authorizeUser('ASSIGN_ROOM')) {
            return new SectorResource(Sector::create($request->all()));
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        if ($this->authService->authorizeUser('ASSIGN_ROOM')) {
            $this->sectorsService->updateSector($sector, $request->all());

            return $sector;
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function destroy(Sector $sector)
    {
        if ($this->authService->authorizeUser('ASSIGN_ROOM')) {
            $this->sectorsService->unsetSectorIdFromRooms($sector->id);
            $sector->delete();

            return new SectorCollection($sector::all());
        }

        return $this->returnErrorCannotPerformAction();
    }

    private function returnErrorCannotPerformAction()
    {
        return response([
            'message' => "You don't have permissions to perform this action!"
        ], Response::HTTP_UNAUTHORIZED);
    }
}
