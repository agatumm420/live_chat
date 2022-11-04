<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Room;
use App\Models\Message;
use Carbon\Carbon;

class MessageSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     *
     */
    public $room_id;
    public $message_author;
    public $message_text;
    public $date;
    public $data;

    public function __construct(Room $room, Message $message)
    {
       // dd("i'm broadcasting");
        $this->room_id=$room->id;
        $this->message_author=$message->user->login;
        $this->message_text=$message->text;
       // dd($this->message_text);
        $this->date=Carbon::now()->toTimeString();
        $this->data=[
            'room'=>$this->room_id,
            'user'=>$this->message_author,
            'text'=>$this->message_text,
            'date'=>$this->date,
            'is_generic'=>$message->generic,
        ];
    }
    public function broadcastAs(){
        return 'message.send';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //dd("i'm broadcasting for realz");
        return new PresenceChannel('room'.$this->room_id);
    }
}
