<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileUser;
use App\Exceptions\EmailTakenException;
use App\Exceptions\NoUserException;

class MobileUserController extends Controller
{
    public function register(Request $request){
        $data=$request->input('data');
        if(MobileUser::where('email', $data['email'])->exists()){
            throw new EmailTakenException('This email is taken', 401);
        }
        else{
            $user=MobileUser::firstOrNew(['email'=>$data['email']]);
            // // $table->string('name');
            // $table->string('login');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $user->name=$data['name'];
            $user->login=$data['login'];
            $user->email=$data['email'];
            $user->password=$data['password'];
            $user->save();
            return response()->json([
                'data'=>[
                    'status'=>'success',
                    'user_id'=>$user->id
                ]
                ]);
        }

    }
    public function update(Request $request){
        $data=$request->input('data');
        if(MobileUser::where('email', $data['email'])->exists()){
            $user=MobileUser::firstOrNew(['email'=>$data['email']]);
            // // $table->string('name');
            // $table->string('login');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $user->name=$data['name'];
            $user->login=$data['login'];

            $user->password=$data['password'];
            $user->save();
            return response()->json([
                'data'=>[
                    'status'=>'success',
                    'user_id'=>$user->id
                ]
                ]);
        }
        else{
            throw new NoUserException('There is not a user with provided email');
        }
    }
}