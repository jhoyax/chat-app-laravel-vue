<?php

namespace App\Http\Controllers\API;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthenticateUserController extends Controller
{
    use AuthenticatesUsers;

    protected $tokenResult;

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        if ($this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        )
        ) {
            $this->tokenResult = $request->user()->createToken('User Token');

            return true;
        }

        return false;
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $token = $this->tokenResult;

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'token' => $token->accessToken,
            'token_type' => 'bearer',
            'expires_at' => Carbon::parse($token->token->expires_at)->format('Y-m-d H:i:s'),
            'expires_at_seconds' => Carbon::parse($token->token->expires_at)->timestamp - Carbon::now()->timestamp,
            'user' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => __('message.success'),
        ], Response::HTTP_OK);
    }
}
