<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /** @test */ 
    public function user_can_be_created()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Lucas Baggio',
            'email' => 'lucas@gmail.com',
            'password' => '12345678',
            'role' => 'client'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'lucas@gmail.com',
            'name' => 'Lucas Baggio',
            'role' => 'client'
        ]);
    } 
}
