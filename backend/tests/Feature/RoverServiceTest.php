<?php

namespace Tests\Feature;

use App\Services\RoverService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoverServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_move_forward() 
    {
        $rover = new RoverService([0, 0], 'N');
        $response = $rover->execute('f');

        $this->assertEquals([0,1], $response['final_position']);
        $this->assertFalse($response['obstacle_found']);
    }

    public function test_move_forward_obstacle() 
    {
        $rover = new RoverService([0, 0], 'N', [[0, 1]]);
        $response = $rover->execute('f');

        $this->assertEquals([0,0], $response['final_position']);
        $this->assertTrue($response['obstacle_found']);
        $this->assertEquals([0, 0], $response['stopped_position']);
        dd($response);
    }

}
