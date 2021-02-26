<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\API\ChatController;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatUpdatesEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $from;
    public $to;

    /**
     * Create a new event instance.
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @return void
     */
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $lowId = $this->from;
        $highId = $this->to;

        if ($lowId > $highId) {
            $lowId = $this->to;
            $highId = $this->from;
        }

        return new PresenceChannel('chat.' . $lowId . '.' . $highId);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'chatUpdates';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $chat = new ChatController;

        return $chat->getChatSingle($this->from, $this->to);
    }
}
