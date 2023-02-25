<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }




    //user 

     public function test_user_index_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/user/index');

        $response->assertStatus(200);
    }

    

    public function test_user_create_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/user/create');

        $response->assertStatus(200);
    }

     public function test_user_edit_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/user/edit/1');

        $response->assertStatus(200);
    }
}
