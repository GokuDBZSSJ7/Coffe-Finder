<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => 'lucas@gmail.com',
            'name' => 'Lucas Baggio',
            'role' => 'client'
        ]);
    }

    /** @test */
    public function user_can_be_updated()
    {
        $user = User::create([
            'name' => 'Lucas Baggio',
            'email' => 'lucas@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);

        $response = $this->putJson('/api/users/' . $user->id, [
            'name' => 'Baggio Lucas'
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_be_found()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_be_found_by_id()
    {
        $user = User::create([
            'name' => 'Lucas Baggio',
            'email' => 'lucas@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);

        $response = $this->getJson('/api/users/' . $user->id);

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $user->id,
            'name' => 'Lucas Baggio',
            'email' => 'lucas@gmail.com',
            'role' => 'client',
        ]);
    }

    /** @test */
    public function user_can_be_deleted()
    {
        $user = User::create([
            'name' => 'Lucas Baggio',
            'email' => 'lucas@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);

        $response = $this->deleteJson('/api/users/' . $user->id);
        $response->assertStatus(200);
    }
}
