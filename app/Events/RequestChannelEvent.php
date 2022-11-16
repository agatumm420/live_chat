<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MobileUser;
use App\Models\Room;

class RequestChannelEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
     public $user_invinting;
     public $user_invited;
     public $room;
     public $data;
    public function __construct(MobileUser $inviting, MobileUser $invited, Room $roomster)
    {
        $this->user_inviting=$inviting;
        $this->user_invited=$invited;
        $this->room=$roomster;
       // dd($inviting);
        $this->data=[
            'data'=>[
                'invited_by'=>$this->user_inviting->login,
                'room_id'=>$this->room->id,
                'room_name'=>$this->room->name

            ]
        ];



    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('request-'.$this->user_invited->id);
    }
}
