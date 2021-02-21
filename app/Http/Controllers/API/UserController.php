<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserAvatarRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RegisterUserRequest  $request
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterUserRequest $request, User $user)
    {
        $user->update($request->all());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $user->avatar = $request->input('avatar');
        $user->save();

        return new UserResource($user);
    }
}
