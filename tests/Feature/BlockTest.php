<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Block;
use App\Models\User;
class BlockTest extends TestCase
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

    public function test_block_can_be_stored_with_post(){
        

        $response = $this->post('/block/store', [
            "program_id"=>1,
             "ordinal" => 1,
            "programpart" => 1,
            "letters"=> "ab",
            "criteria" => "hello",
            "maxmark"=>1,
            "coefficient"=>1,
           
        ]);
        $response->assertSessionHasNoErrors();
    }

     public function test_block_can_be_updated_with_patch(){
        
        $block = Block::all()->first();
        $id = $block->id;
        
        $response = $this->patch('/block/update/'.$id, [
            "program_id"=>1,
             "ordinal" => 1,
            "programpart" => 1,
            "letters"=> "abba",
            "criteria" => "hello",
            "maxmark"=>1,
            "coefficient"=>1,
           
        ]);
        $response->assertSessionHasNoErrors();
        $block = Block::find($id)->get();
        $this->assertEquals($block->first()->letters,"abba");
    }


}
