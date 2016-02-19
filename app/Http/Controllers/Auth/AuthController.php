<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\AuthRequests;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends ApiController
{
    public function auth(AuthRequests $request)
    {
        $credentials = $request->only(['username', 'password']);
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return $this->responseUnauthorized('Wrong credentials');
        }

        $customClaims = ['user_id' => $user->id];

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials, $customClaims)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function info()
    {
        try {
            $token   = \JWTAuth::getToken();
            $payload =  \JWTAuth::getPayload($token);
        } catch (JWTException $e) {
            return ['error' => 'no auth token provided'];
        }

        $user = User::where('id', $payload['user_id'])->first();

        return $user;
    }
}