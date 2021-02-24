<?php

namespace App\Http\Controllers\API;

use App\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Http\Requests\StoreChatRequest;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chats = Chat::filterByFromAndTo($request->input('from'), $request->input('to'))
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
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Chat::filterByFromAndTo($request->input('from'), $request->input('to'))->delete();
    }
}
