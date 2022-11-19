<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\MessageResource;

class MessageCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $messages=$this->collection->map(function ($message){
            return new MessageResource($message);
         })->toArray();
         return [
             "data" => [

                 // "categories" => new CategoryCollection(CategoryShop::OnList()->get()),
                "messages" =>$messages,
             //    "shops" => $this->collection->toArray(),
             ]
         ];
    }
}
