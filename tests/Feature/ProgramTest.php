<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Program;

class ProgramTest extends TestCase
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


    public function test_program_can_be_stored_with_post(){
        

        $response = $this->post('/program/store', [
            "name"=>"Test program",
             "discipline" => "poniklub",
            "numofblocks" => 11,
            "maxMark"=> 200,
            "typeofevent" => "normal",
            "doublesided"=>1,
           
        ]);
        $response->assertSessionHasNoErrors();
    }

     public function test_program_can_be_updated_with_patch(){
        
        $program = Program::all()->first();
        $id = $program->id;
        $response = $this->patch('/program/update/'.$id, [
            "name"=>"Test program",
             "discipline" => "poniklub",
            "numofblocks" => 11,
            "maxMark"=> 200,
            "typeofevent" => "normal",
            "doublesided"=>1,
           
        ]);
        $response->assertSessionHasNoErrors();
        $program = Program::find($id)->get();
        $this->assertEquals($program->first()->name,"Test program");
    }
}
