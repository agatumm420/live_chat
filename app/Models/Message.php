<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['user_id', 'text', 'generic'];
    use HasFactory;
    public function user(){
        return  $this->belongsTo(MobileUser::class, "user_id", "id");
     }
     public function room(){
        return  $this->belongsTo(Room::class, "room_id", "id");
     }
}
