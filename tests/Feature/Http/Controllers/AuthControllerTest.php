<?php

namespace Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseMigrations;

    private string $url = "/api/auth/";

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_register()
    {
        $response = $this->post($this->url . 'register/', [
            'name' => rand(1, 1000) . 'abc',
            'email' => rand(1, 1000) . 'abc@skdjsk.com',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $response->assertStatus(201);
    }

    public function test_logout()
    {
        $user = User::first();
        $token = auth()->fromUser($user);

        $response = $this->post($this->url . 'logout/', [], [
            'Authorization' => 'bearer ' . $token
        ]);

        $response->assertStatus(200);
    }

    public function test_refresh()
    {
        $user = User::first();
        $token = auth()->fromUser($user);

        $response = $this->post($this->url . 'refresh/', [], [
            'Authorization' => 'bearer ' . $token
        ]);

        $response->assertStatus(200);
    }

    public function testUserProfile()
    {
        $user = User::first();
        $token = auth()->fromUser($user);

        $response = $this->get($this->url . 'user-profile', [
            'Authorization' => 'bearer ' . $token
        ]);

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'abc@skdjsk.com',
            'password' => bcrypt('1234567'),
        ]);

        $response = $this->post($this->url . 'login', [
            'email' => $user->email,
            'password' => '1234567',
        ]);

        $response->assertStatus(200);
    }
}
