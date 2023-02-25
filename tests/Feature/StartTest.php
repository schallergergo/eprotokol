<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Start;
use App\Models\Event;

class StartTest extends TestCase
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

 public function test_start_can_be_stored_with_event_post(){
        
        $event = Event::all()->first();
        $id=$event->id;
        $response = $this->post('/start/store/'.$id, [
           "rider_id"=>12345,
           "rider_name"=>"Schaller Gergő",
           "horse_id"=>12345,
           "horse_name"=>"Schaller Gergő",
           "club"=>"Panka Póni Klub",
           "category"=>"Kezdő",
           
        ]);
        $response->assertSessionHasNoErrors();
    }
    /*
     public function test_start_can_be_updated_with_patch(){
        
        $start=Start::all()->first();
        $response = $this->patch('/start/update/'.$start->id, [

           "rider_id"=>12345,
           "rider_name"=>"Schaller Gergő",
           "horse_id"=>12345,
           "horse_name"=>"Schaller Gergő",
           "club"=>"Panka Póni Klub",
           "category"=>"Kezdő",
           "original_category"=>"Haladó",
           
        ]);
        $response->assertSessionHasNoErrors();
        $start=Start::find($start->id)->get();
        $this->assertEquals($start->first()->rider_name,"Schaller Gergő");
    }
*/

}
