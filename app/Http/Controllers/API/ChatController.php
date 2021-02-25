<?php

namespace App\Http\Controllers\API;

use App\Chat;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\GetChatListRequest;
use App\Http\Requests\GetChatSingleRequest;
use App\Http\Requests\DestroyChatSingleRequest;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\GetChatListRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function chatList(GetChatListRequest $request)
    {
        $chats = Chat::groupChatByFrom($request->input('from'))
                    ->filterByToName($request->input('name'))
                    ->orderByDesc('id')
                    ->get();

        return ChatResource::collection($chats);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\GetChatSingleRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function chatSingle(GetChatSingleRequest $request)
    {
        $chats = Chat::getAllChatByFromAndTo($request->input('from'), $request->input('to'))
                    ->orderBy('id')
                    ->get();

        $getToUserLastChat = Chat::where(function ($query) use ($request) {
            $query->getAllChatByFromAndTo($request->input('from'), $request->input('to'));
        })->where('to', $request->input('to'))
        ->orderByDesc('id')
        ->first();

        $toDetails = [];
        if ($getToUserLastChat) {
            $getToUserLastChat = collect(new ChatResource($getToUserLastChat))->toArray();
            $toDetails = [
                'id' => $getToUserLastChat['to'],
                'name' => $getToUserLastChat['to_name'],
                'avatar' => $getToUserLastChat['to_avatar'],
            ];
        } else {
            $user = User::find($request->input('to'));
            if ($user) {
                $toDetails = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $user->avatar,
                ];
            }
        }

        return [
            'chats' => ChatResource::collection($chats),
            'toDetails' => $toDetails,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChatRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChatRequest $request)
    {
        $chat = Chat::create([
            'from' => $request->user()->id,
            'to' => intval($request->input('to')),
            'to_name' => $request->input('to_name'),
            'message' => $request->input('message'),
        ]);

        return new ChatResource($chat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\DestroyChatSingleRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyChatSingle(DestroyChatSingleRequest $request)
    {
        return Chat::getAllChatByFromAndTo($request->input('from'), $request->input('to'))
                ->delete();
    }
}
