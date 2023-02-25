<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Result;
class ResultShowCanBeRenderedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_result_show_view_can_be_rendered()
    {
        $results=Result::all();
        foreach($results as $result){
            $response = $this->get('/result/show/'.$result->id);

                $response->assertStatus(200);
        }
    }
}
