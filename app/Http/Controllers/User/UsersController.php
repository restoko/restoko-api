<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UsersController extends ApiController
{
    public function all()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return $this->responseNotFound(['Users is empty']);
        }

        return $this->responseOk($users);
    }

    public function store(StoreUserRequest $request)
    {
        $input = $request->all();

        $user = User::create($input);

        return $this->createResponse($user);
    }

    public function update(StoreUserRequest $request, $userId)
    {
        $input = $request->all();

        $user = User::where('id', $userId)->update($input);

        return $this->createResponse($user);
    }

    public function destroy($userId)
    {
        $user = User::find($userId)->delete();

        if (! $user) {
            return $this->responseNotFound(['User Id not found']);
        }

        return $this->responseOk($user);
    }

}
