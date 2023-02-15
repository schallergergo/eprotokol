<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Start;

class ViewsCanBeRenderedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_contact_can_be_rendered()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

     public function test_program_index_can_be_rendered()
    {
        $response = $this->get('/program/index');

        $response->assertStatus(200);
    }

    public function test_program_show_can_be_rendered()
    {
        $response = $this->get('/program/show/1');

        $response->assertStatus(200);
    }

    public function test_program_create_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/program/create');

        $response->assertStatus(200);
    }

     public function test_program_edit_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/program/edit/1');

        $response->assertStatus(200);
    }

    //Block


    public function test_block_create_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/block/create/1');

        $response->assertStatus(200);
    }

     public function test_block_edit_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/block/edit/1');

        $response->assertStatus(200);
    }

    //Start 

     public function test_start_index_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/start/index/1');

        $response->assertStatus(200);
    }

   

    public function test_start_create_can_be_rendered()
    {   
        
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/start/create/1');

        $response->assertStatus(200);
    }

     public function test_start_edit_can_be_rendered()
    {
        $start = Start::factory()->create();
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/start/edit/'.$start->id);

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


        //result 

   

    public function test_result_show_can_be_rendered()
    {
        $response = $this->get('/result/show/100337663091973667');

        $response->assertStatus(200);
    }



     public function test_result_edit_can_be_rendered()
    {   
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/result/edit/100337663091973667');

        $response->assertStatus(200);
    }


        //event

   
    public function test_event_show_can_be_rendered()
    {
        $response = $this->get('/event/show/1');

        $response->assertStatus(200);
    }

    public function test_event_create_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/event/create/1');

        $response->assertStatus(200);
    }

     public function test_event_edit_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/event/edit/1');

        $response->assertStatus(200);
    }


     //competition

     public function test_competition_index_can_be_rendered()
    {
        $response = $this->get('/competition/index');

        $response->assertStatus(200);
    }

    public function test_competition_show_can_be_rendered()
    {
        $response = $this->get('/competition/show/1');

        $response->assertStatus(200);
    }

    public function test_competition_create_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/competition/create');

        $response->assertStatus(200);
    }

     public function test_competition_edit_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/competition/edit/1');

        $response->assertStatus(200);
    }

    //championship

     public function test_championship_index_can_be_rendered()
    {
        $response = $this->get('/championship/index');

        $response->assertStatus(200);
    }

    public function test_championship_show_can_be_rendered()
    {
        $response = $this->get('/championship/show/3');

        $response->assertStatus(200);
    }

    public function test_championship_create_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/championship/create');

        $response->assertStatus(200);
    }

     public function test_championship_edit_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/championship/edit/3');

        $response->assertStatus(200);
    }


//official


   

    public function test_official_create_can_be_rendered()
    {
        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/official/create/1');

        $response->assertStatus(200);
    }

     public function test_official_edit_can_be_rendered()
    {

        $user=User::where("role","admin")->get()->first();
        $response = $this->actingAs($user)->get('/official/edit/10');

        $response->assertStatus(200);
    }


}
