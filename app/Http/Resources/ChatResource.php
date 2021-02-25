<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $from = User::find($this->from);
        $to = User::find($this->to);

        return [
            'id' => $this->id,
            'from' => $this->from,
            'from_name' => $from ? $from->name : '',
            'from_avatar' => $from ? $from->avatar : '',
            'to' => $this->to,
            'to_name' => $this->to_name,
            'to_avatar' => $to ? $to->avatar : '',
            'message' => $this->message,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
