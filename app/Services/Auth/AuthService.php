<?php

namespace App\Services\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService
{
    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            throw ValidationException::withMessages(['email' => ['Unauthorized']]);
        }

        return $this->formatTokenResponse($token);
    }

    public function logout()
    {
        try {
            if ($token = JWTAuth::getToken()) {
                JWTAuth::invalidate($token);
            }
        } catch (JWTException $e) {
            throw new \Exception('Unable to logout. Token is invalid.');
        }
    }

    public function refresh()
    {
        try {
            if ($token = JWTAuth::getToken()) {
                return $this->formatTokenResponse(JWTAuth::refresh($token));
            }
            throw new \Exception('Token not found.');
        } catch (JWTException $e) {
            throw new \Exception('Unable to refresh token.');
        }
    }

    public function profile()
    {
        return Auth::user();
    }

    private function formatTokenResponse($token)
    {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => null,
            'user' => Auth::user()
        ];
    }
}
