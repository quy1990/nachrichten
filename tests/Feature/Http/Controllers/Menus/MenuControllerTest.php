<?php

namespace Http\Controllers\Menus;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/menus/";

    private $model;
    private array $header;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = Menu::factory()->create(['name' => 'menu 1', 'route' => '/route1', 'icon' => 'icon1']);
        $role = Role::factory()->create(['name' => 'Administrator']);
        $user = User::factory()->create();
        $user->roles()->attach($role);
        $token = auth()->fromUser($user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];

        $role = Role::factory()->create(['name' => 'User']);
        $this->normalUser = User::factory()->create();
        $this->normalUser->roles()->attach($role);
        $normalUserToken = auth()->fromUser($this->normalUser);
        $this->normalUserHeader = [
            'Authorization' => 'bearer ' . $normalUserToken
        ];
    }

    public function test_show_for_admin()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
        $response->assertStatus(200);
    }

    public function test_store_for_admin()
    {
        $response = $this->post($this->url, [
            'name'  => 'abc',
            'route' => '/route1',
            'icon'  => 'icon1'
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update_for_admin()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name'  => 'abc',
            'route' => '/route1',
            'icon'  => 'icon1'
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_destroy_for_admin()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->header);
        $response->assertStatus(204);
    }

    public function test_index_for_admin()
    {
        $response = $this->get($this->url, $this->header);
        $response->assertStatus(200);
    }

    public function test_show_for_normal_user()
    {
        $response = $this->get($this->url . $this->model->id, $this->normalUserHeader);
        $response->assertStatus(403);
    }

    public function test_store_for_normal_user()
    {
        $response = $this->post($this->url, [
            'name'  => 'abc',
            'route' => '/route1',
            'icon'  => 'icon1'
        ], $this->normalUserHeader);

        $response->assertStatus(403);
    }

    public function test_update_for_normal_user()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name'  => 'abc',
            'route' => '/route1',
            'icon'  => 'icon1'
        ], $this->normalUserHeader);

        $response->assertStatus(403);
    }

    public function test_destroy_for_normal_user()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->normalUserHeader);
        $response->assertStatus(403);
    }

    public function test_index_for_normal_user()
    {
        $response = $this->get($this->url, $this->normalUserHeader);
        $response->assertStatus(403);
    }
}
