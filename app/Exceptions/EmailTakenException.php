<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class EmailTakenException extends Exception
{
    public function render($request){
        return new JsonResponse([
            'errors'=>[
                'message'=>'This email is taken',
            ]
            ], $this->code);
    }
}
