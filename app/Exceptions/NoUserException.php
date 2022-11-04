<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class NoUserException extends Exception
{
     public function render($request){
        return new JsonResponse([
            'errors'=>[
                'message'=>"There's no user with this email.",
            ]
            ], $this->code);
    }
}
