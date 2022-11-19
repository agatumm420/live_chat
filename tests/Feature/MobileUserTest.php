<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\MobileUser;

class MobileUserTest extends TestCase
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
    public function test_login(){
        $response = $this->post('http://127.0.0.1:8000/api/login', [
                    'data'=>[


                        'email'=>'agnieszkatumm@gmail.com',
                        'password'=>'GuGu2325'
                    ]
                ]);
                $response->assertStatus(200);
    }
    // public function test_rooms(){
    //     $response = $this->get('http://127.0.0.1:8000/api/rooms/3'
    //     );
    //     //dd($response);
    //     $response->assertStatus(200);
    // }
}
