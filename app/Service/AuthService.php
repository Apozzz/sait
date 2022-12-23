<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function assignRolesToTokens(Authenticatable $user)
    {
        $token = null;
        $tokenUserId = $user->getAuthIdentifier();
        $userModel = User::find($tokenUserId);

        switch ($userModel->role) {
            case User::ADMIN:
                $token = $user->createToken('token', ['*'])->plainTextToken . '=admin';
                break;
            case User::MEMBER:
                $token = $user->createToken('token', ['get', 'create', 'rentRoom', 'update', 'delete'])->plainTextToken . '=member';
                break;
            default:
                $token = $user->createToken('token', ['get'])->plainTextToken . '=user';
        }

        return $token;
    }

    public function authorizeUser(string $callType)
    {
        if (!$user = Auth::user()) {
            return strtolower($callType) === config('callTypes.GET');
        }

        return $user->tokenCan(config('callTypes.' . $callType));
    }

    public function getUser()
    {
        return Auth::user();
    }
}
