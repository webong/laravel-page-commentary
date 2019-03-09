<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $page;
    public $username;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($page, $username)
    {
        $this->page = $page;
        $this->username = $username;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('page-'.$this->page);
    }

    public function broadcastAs()
    {
        return 'new-comment';
    }
}
