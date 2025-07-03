<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoverApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_api_start_success() 
    {
        $data = [
            'initial_position' => [0, 0],
            'direction' => 'N',
            'commands' => 'frf',
            'obstacles' => [[1, 1]]
        ];

        $response = $this->postJson('/api/rover/start', $data);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'final_position' => [0, 1],
            'direction' => 'E',
            'obstacle_found' => true,
            'stopped_position' => [0, 1]
        ]);
    }

    public function test_api_start_failure() 
    {
        $data = [
            'initial_position' => [0],
            'direction' => 'N',
            'commands' => 'frf',
            'obstacles' => [[1, 1]]
        ]; 
        $response = $this->postJson('/api/rover/start', $data);
        $response->assertStatus(422);

    }
}
