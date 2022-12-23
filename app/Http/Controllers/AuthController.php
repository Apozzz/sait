<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $role = $request->input('role') === User::ADMIN || $request->input('role') ? User::ADMIN : User::MEMBER;

        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $role,
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $authService = new AuthService();
        $token = $authService->assignRolesToTokens($user);
        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'message' => $token
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user() ?? null;
    }

    public function logout()
    {
        if (Cookie::get('jwt')) {
            $cookie = Cookie::forget('jwt');
        }

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }

    public function refresh(): Response
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token): Response
    {
        return response([
            'status' => ResponseAlias::HTTP_OK,
            'success' => true,
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]
        ]);
    }
}
