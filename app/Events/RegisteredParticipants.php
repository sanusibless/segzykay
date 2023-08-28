<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisteredParticipants implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $participant
    /**
     * Create a new event instance.
     */
    public function __construct(User $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('new-participant'),
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return String Event new participant
     */
    public function broadcastAs()
    {
        return 'notify-new-participant';
    }
}
