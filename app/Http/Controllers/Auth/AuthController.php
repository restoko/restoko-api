<?php
namespace App\Cliqnship\Authentication\Http\Controllers;

use App\Abstracts\AbstractController;
use App\Cliqnship\Authentication\Http\Requests\AuthRequest;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends AbstractController
{
    public function auth(AuthRequest $request)
    {
        $credentials = $request->only(['username', 'password']);
        $user = User::where('username', $credentials['username'])->first();

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
        $token   = \JWTAuth::getToken();
        $payload =  \JWTAuth::getPayload($token);

        $user = User::with('customerDetail', 'contactNumbers', 'group')->where('id', $payload['user_id'])->first();

        return $user;
    }
}