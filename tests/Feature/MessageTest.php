<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class MessageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send()
    {
        $user=User::find(1);

        $response = $this->post('http://127.0.0.1:8000/api/send/1', [
            'data'=>[
                'text'=>'hello, world',
                'user_id'=>1
            ]
        ]);
       // dd($response);
        $response->assertStatus(200);
    }
    public function test_testy()
    {
        $user=User::find(1);

        $response = $this->get('http://127.0.0.1:8000/test');
        //dd($response);
        $response->assertStatus(200);
    }
}
