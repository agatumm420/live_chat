<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\MobileUser;
use App\Models\Message;
use App\Events\RequestChannelEvent;
use App\Events\MessageSend;
class RoomController extends Controller
{
    public function create_room(Request $request, MobileUser $mobile_user){
        $data=$request->input('data');

        $room=Room::firstOrNew(['name'=>$data['name'], 'admin'=>$mobile_user->id]);
        //dd($room);
        $room->name=$data['name'];
        $room->admin=$mobile_user->id;
        if($data['image']){
            $room->image=$data['image'];
        }
        $room->save();
        $mobile_user->rooms()->attach($room->id);
        $room->save();
        $inviting=$mobile_user;

        foreach($data['members'] as $member){
            //dd($member->login);
            $user=MobileUser::where('login', $member->login)->first();
            //dd($mobile_user);
            broadcast(new RequestChannelEvent($mobile_user, $user, $room ));
            $user->rooms_invited()->attach($room->id);
            $room->users_invited()->attach($user->id);
            $msg=Message::create([
                'text'=>'Room successfullly created. Waiting for members to accept invitation',
                 'generic'=>true
            ]);
            broadcast(new MessageSend($room, $msg) );


        };
        return response()->json([
            'data'=>[
                'room_id'=>$room->id,
                 'room_name'=>$room->name,
                 'admin'=>$inviting->id,
            ]]);
    }
    public function accept_room_invitation(Request $request, Room $room){
        $data=$request->input('data');
        $room->users_invited()->detach($data['user_id']);
        $room->users_accepted()->attach($data['user_id']);
        $user=MobileUser::find($data['user_id']);
        $user->rooms()->attach($room->id);
        $user->roooms_invited()->detach($room->id);

        $msg=Message::create([
            'text'=>'User '. $user->login.' accepted room invitation. ',
             'generic'=>true
        ]);
        broadcast(new MessageSend($room, $msg) );
        return response()->json([
            'data'=>[
                'room_id'=>$room->id,
                 'room_name'=>$room->name,
                 'new_chatter'=>$user->id,
            ]]);
    }
}
