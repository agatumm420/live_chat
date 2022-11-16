<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileUser;
use App\Exceptions\EmailTakenException;
use App\Exceptions\NoUserException;
use App\Exceptions\PasswordNotMatch;


class MobileUserController extends Controller
{
    public function register(Request $request){
        $data=$request->input('data');
       // dd($request);
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
            //dd()
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
            throw new NoUserException('There is not a user with provided email',401);
        }
    }
    public function login(Request $request){
        $data=$request->input('data');
        if(MobileUser::where('email', $data['email'])->exists()){
            $user=MobileUser::where('email', $data['email'])->first();
            if($user->password==$data['password']){
                return response()->json([
                    'data'=>[
                        'login'=>$user->login,

                        'user_id'=>$user->id
                    ]
                ]);
            }
            else{
                throw new PasswordNotMatch('Inncorect password', 401);
            }
        }
        else{
            throw new NoUserException('There is not a user with provided email',401);
        }
    }
    public function user_rooms(MobileUser $user){
        return response()->json([
            'data'=>[
                'user_id'=>$user->id,
                'rooms'=>$user->rooms
            ]
        ]);
    }
}
