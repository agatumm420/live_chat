<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use App\Events\MessageSend;
class MessageController extends Controller
{
    public function sendMessage( Request $request, Room $room){
        //dd('I ve made it');
        $data=$request->input('data');
        $message=Message::create(['text'=>$data['text'], 'user_id'=>$data['user_id'],'room'=>$room->id ]);//czy to robić
        // $message->text=$data['text'];
        // $message->user_id=$data['user_id'];
        // $message->room_id=$room->id;
        $message->save();
        broadcast(new MessageSend($room, $message));
        return response()->json([
            'status'=>'succces'
        ]);
    }
    public function test(){
        return response()->json([
            'status'=>'succces'
        ]);
    }
}
