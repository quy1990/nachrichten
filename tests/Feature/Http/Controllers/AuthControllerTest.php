<?php

namespace Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/auth/";

    private $user;

    private $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->token = auth()->fromUser($this->user);
    }

    public function test_register()
    {
        $response = $this->post($this->url . 'register/', [
            'name'                  => rand(1, 1000) . 'abc',
            'email'                 => rand(1, 1000) . 'abc@skdjsk.com',
            'password'              => '1234567',
            'password_confirmation' => '1234567',
        ]);

        $response->assertStatus(201);
    }

    public function test_logout()
    {
        $response = $this->post($this->url . 'logout/', [], [
            'Authorization' => 'bearer ' . $this->token
        ]);

        $response->assertStatus(200);
    }

    public function test_refresh()
    {
        $response = $this->post($this->url . 'refresh/', [], [
            'Authorization' => 'bearer ' . $this->token
        ]);

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $user = User::factory()->create([
            'email'    => 'abc@skdjsk.com',
            'password' => bcrypt('1234567'),
        ]);

        $response = $this->post($this->url . 'login', [
            'email'    => $user->email,
            'password' => '1234567',
        ]);

        $response->assertStatus(200);
    }

    public function test_get_profile()
    {
        $response = $this->get($this->url . 'user-profile/', [
            'Authorization' => 'bearer ' . $this->token
        ]);

        $response->assertStatus(200);
    }

    public function test_login_fail()
    {
        $user = User::factory()->create([
            'email'    => 'abc@skdjsk.com',
            'password' => bcrypt('1234567'),
        ]);

        $response = $this->post($this->url . 'login', [
            'email'    => $user->email,
            'password' => '1234567____',
        ]);

        $response->assertStatus(401);
    }
}
