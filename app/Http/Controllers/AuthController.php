<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    protected function createNewToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'user'         => auth()->user()
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create(array_merge(
            $request->validated(),
            ['password' => bcrypt($request->get("password"))]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh(): JsonResponse
    {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * @throws Exception
     */
    public function uploadAvatar(Request $request): JsonResponse
    {
        try {
            $path = $request->file('avatar')->store('avatar', 'public');
            $user = auth()->user();
            $oldAvatar = storage_path('app/public/' . $user->avatar);
            if (file_exists($oldAvatar)) {
                unlink($oldAvatar);
            }
            $user->avatar = $path;
            $user->save();

            return response()->json([
                'message' => 'Avatar successfully registered',
                'avatar'  => $user->avatar
            ], 201);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    public function getAvatar()
    {
        return response()->download(storage_path('app/public/' . auth()->user()->avatar));
    }

    public function getUrlAvatar(Request $request)
    {
        $host = $request->header()['host'][0];
        return response()->json([
            'data' => 'http://' . $host . '/storage/' . auth()->user()->avatar
        ]);
    }
}
