<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Requests\V1\UpdateRoomRequest;
use App\Models\Room;
use App\Models\User;

class RoomsService
{
    public function createRoom(array $data)
    {
        $room = new Room();
        $room->number = $data['number'];
        $room->space = $data['space'];
        $room->booked_from = $data['booked_from'] ?? null;
        $room->booked_to = $data['booked_to'] ?? null;
        $room->sector_id = $data['sector_id'] ?? null;
        $room->timestamps = false;
        $room->save();

        return $room;
    }

    public function updateRoom(Room $room, array $data)
    {
        $room->number = $data['number'] ?? $room->number;
        $room->space = $data['space'] ?? $room->space;
        $room->booked_from = $data['booked_from'] ?? $room->booked_from;
        $room->booked_to = $data['booked_to'] ?? $room->booked_to;
        $room->sector_id = $data['sector_id'] ?? $room->sector_id;
        $room->timestamps = false;
        $room->update();
    }

    public function checkIfUsersRoom(int $userId, int $roomId)
    {
        $userWithRoomId = User::where('room_id', $roomId)->get()->first();

        return $userWithRoomId ? $userWithRoomId->id === $userId : false;
    }

    public function checkRoomBooking(UpdateRoomRequest $request, int $roomId)
    {
        $bookedFrom = $request->get('booked_from');
        $bookedTo = $request->get('booked_to');

        if (!$bookedFrom || !$bookedTo) {
            return false;
        }

        if ($bookedFrom > $bookedTo) {
            return false;
        }

        $user = $request->user();

        if ($user) {
            $user->room_id = $roomId;
            $user->save();
        }

        return true;
    }

    public function unsetRoomFromUser(int $roomId)
    {
        $userWithRoomId = User::where('room_id', $roomId)->get()->first();
        if (!$userWithRoomId) {return;}
        $userWithRoomId->room_id = null;
        $userWithRoomId->update();
    }
}
