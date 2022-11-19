<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\MobileUser;
class Member{
    public $login;
    public function __constructor($login)
    {
        $this->login=$login;
    }
}
class RoomTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_register()
    // {


    //     $response = $this->post('http://127.0.0.1:8000/api/register', [
    //         'data'=>[
    //             'name'=>'Baha Tumm',
    //             'login'=>'bunia420',
    //             'email'=>'bunia@gmail.com',
    //             'password'=>'GuGu2325'
    //         ]
    //     ]);
    //    // dd($response);
    //     $response->assertStatus(200);
    // }
    // public function test_update()
    // {
    //     $response = $this->post('http://127.0.0.1:8000/api/update', [
    //         'data'=>[
    //             'name'=>'Agnieszka Tumm',
    //             'login'=>'agabumm420blazeit',
    //             'email'=>'agnieszkatumm@gmail.com',
    //             'password'=>'GuGu2325'
    //         ]
    //     ]);
    //     $response->assertStatus(200);
    //     // $user=User::find(1);

    //     // $response = $this->get('http://127.0.0.1:8000/test');
    //     // //dd($response);
    //     // $response->assertStatus(200);
    // }
    // public function test_create_room(){
    //     $member1=new Member();
    //     $member1->login='bunia420';
    //     $member2=new Member();
    //     $member2->login='et';
    //     $response = $this->post('http://127.0.0.1:8000/api/create_room/3', [
    //                 'data'=>[


    //                     'name'=>'Test Room',
    //                     'image'=>'https://images.unsplash.com/photo-1498940757830-82f7813bf178?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80',
    //                     'members'=>[
    //                         $member1, $member2
    //                     ]
    //                 ]
    //             ]);
    //            // dd($response);
    //             $response->assertStatus(200);
    // }
    // public function test_rooms(){
    //     $response = $this->get('http://127.0.0.1:8000/api/rooms/3'
    //     );
    //     dd($response);
    //     $response->assertStatus(200);
    // }
    public function test_room(){
            $response = $this->get('http://127.0.0.1:8000/api/room/3'
        );
        dd($response['data']);
        $response->assertStatus(200);
    }
}
