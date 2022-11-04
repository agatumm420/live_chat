<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
class Room extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public function messages(){
        return  $this->belongsToMany(Message::class, 'rooms_messages','room_id' ,'message_id');
    }
    public function users_accepted(){
        return $this->belongsToMany(MobileUsers::class,'rooms_users', 'room_id', 'user_id'  );
    }
    public function users_invited(){
        return $this->belongsToMany(MobileUsers::class,'rooms_users_invited', 'room_id', 'user_id' );
    }
}
