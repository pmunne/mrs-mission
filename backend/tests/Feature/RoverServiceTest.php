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
    }

    public function test_move_left() 
    {
        $rover = new RoverService([0, 0], 'N');
        $response = $rover->execute('l');
        $this->assertEquals([0,0], $response['final_position']);
        $this->assertEquals('W', $response['direction']);
    }

    public function test_move_right() 
    {
        $rover = new RoverService([0, 0], 'N');
        $response = $rover->execute('r');
        $this->assertEquals([0,0], $response['final_position']);
        $this->assertEquals('E', $response['direction']);
    }

    public function test_move_left_obstacle() 
    {
        $rover = new RoverService([0, 0], 'N', [[1, 0]]);
        $response = $rover->execute('l');

        $this->assertEquals([0,0], $response['final_position']);
        $this->assertFalse($response['obstacle_found']);
        $this->assertEquals('W', $response['direction']);
    }

    public function test_move_right_obstacle() 
    {
        $rover = new RoverService([0, 0], 'N', [[1, 0]]);
        $response = $rover->execute('r');

        $this->assertEquals([0,0], $response['final_position']);
        $this->assertFalse($response['obstacle_found']);
        $this->assertEquals('E', $response['direction']);
    }

    public function test_move_multiple_commands()
   {
        $rover = new RoverService([0, 0], 'N');
        $response = $rover->execute('frffflfff' );

        $this->assertEquals([3, 4], $response['final_position']);
        $this->assertFalse($response['obstacle_found']);
        $this->assertEquals('N', $response['direction']);
   } 

   public function test_move_multiple_commands_obstacles()
   {
        $rover = new RoverService([0, 0], 'N', [[1, 1], [2, 2]]);
        $response = $rover->execute('frffflfff');

        $this->assertEquals([0, 1], $response['final_position']);
        $this->assertTrue($response['obstacle_found']);
        $this->assertEquals([0, 1], $response['stopped_position']);
        $this->assertEquals('E', $response['direction']);
   }

}
