<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = [

            'user_id' => $this->user_id,
            'login' => $this->user->id,
            'image' => $this->user->image,
            'text'=>$this->text

        ];
        return $arr;
    }
}
