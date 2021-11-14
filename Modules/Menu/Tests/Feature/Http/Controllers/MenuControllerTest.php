<?php

namespace Modules\Menu\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Menu\Entities\Menu;
use Modules\User\Entities\User;
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
        $user = User::factory()->create();
        $token = auth()->fromUser($user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'name' => 'abc', 'route' => '/route1', 'icon' => 'icon1'
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'abc', 'route' => '/route1', 'icon' => 'icon1'
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->header);
        $response->assertStatus(204);
    }

    public function test_index()
    {
        $response = $this->get($this->url, $this->header);
        $response->assertStatus(200);
    }
}
