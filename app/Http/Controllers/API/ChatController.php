<?php

namespace App\Http\Controllers\API;

use App\Chat;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\DestroyChatRequest;
use App\Http\Requests\GetChatListRequest;
use App\Http\Requests\GetChatSingleRequest;

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

        return ChatResource::collection($chats);
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
     * @param  \App\Http\Requests\DestroyChatRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyChatRequest $request)
    {
        return Chat::getAllChatByFromAndTo($request->input('from'), $request->input('to'))
                ->delete();
    }
}
