<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Traits\HasUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserAvatarRequest;

class UserController extends Controller
{
    use HasUpload;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::filterByName($request->input('name'))->get();

        return UserResource::collection($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RegisterUserRequest  $request
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return new UserResource($user);
    }

    /**
     * Update the avatar
     *
     * @param  \App\Http\Requests\UpdateUserAvatarRequest  $request
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(UpdateUserAvatarRequest $request, User $user)
    {
        $oldAvatar = $user->avatar;

        $user->avatar = $this->storeFile($request->file('avatar'));
        $user->save();

        $this->deleteFile($oldAvatar);

        return new UserResource($user);
    }

    /**
     * Get user by id
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request)
    {
        $user = $request->user();

        $id = intval($request->input('id'));
        if ($id) {
            $user = User::find($id);
        }

        return new UserResource($user);
    }
}
