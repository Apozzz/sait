<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreRoomRequest;
use App\Http\Requests\V1\UpdateRoomRequest;
use App\Http\Resources\V1\RoomCollection;
use App\Http\Resources\V1\RoomResource;
use App\Models\Room;
use App\Service\AuthService;
use App\Service\RoomsService;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    private $authService;

    private $roomsService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->roomsService = new RoomsService();
    }

    public function index()
    {
        if ($this->authService->authorizeUser('GET')) {
            return new RoomCollection(Room::all());
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function show(Room $room)
    {
        if ($this->authService->authorizeUser('GET')) {
            return new RoomResource($room);
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function store(StoreRoomRequest $request)
    {
        if ($this->authService->authorizeUser('ASSIGN_ROOM')) {
            return new RoomResource($this->roomsService->createRoom($request->toArray()));
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        if ($this->authService->authorizeUser('RENT_ROOM') && $this->roomsService->checkRoomBooking($request, $room->id)) {
            $this->roomsService->updateRoom($room, $request->toArray());

            return $room;
        }

        if ($this->authService->authorizeUser('ASSIGN_ROOM')) {
            $request = $request->toArray();
            unset($request['booked_from'], $request['booked_to']);
            $this->roomsService->updateRoom($room, $request);

            return $room;
        }

        return $this->returnErrorCannotPerformAction();
    }

    public function destroy(Room $room)
    {
        if ($this->authService->authorizeUser('ASSIGN_ROOM')) {
            $this->roomsService->unsetRoomFromUser($room->id);
            $room->delete();

            return new RoomCollection($room::all());
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
