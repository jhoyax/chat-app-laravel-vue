<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'AuthenticateUserController@logout');

        Route::prefix('users')->group(function () {
            Route::get('/', 'UserController@index');
            Route::get('get-by-id', 'UserController@getById');
            Route::put('{user}', 'UserController@update');
            Route::put('{user}/update-avatar', 'UserController@updateAvatar');
        });

        Route::prefix('chats')->group(function () {
            Route::get('chat-list', 'ChatController@chatList');
            Route::get('chat-single', 'ChatController@chatSingle');
            Route::post('/', 'ChatController@store');
            Route::delete('chat-single', 'ChatController@destroyChatSingle');
        });
    });

    Route::post('login', 'AuthenticateUserController@login');
    Route::post('register', 'RegisterUserController@register');
});

Route::namespace('Auth')->group(function () {
    Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');

    Route::get('reset-password', function (Request $request) {
        return redirect('reset-password/' . $request->input('token') . '/' . $request->input('email'));
    });
    Route::post('reset-password', 'ResetPasswordController@reset')->name('password.reset');
});
