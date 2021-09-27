<?php

namespace Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use DatabaseMigrations;

    private string $url = "/api/roles/";

    private $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = Role::factory()->create();
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'name' => 'abc',
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'abc 123',
        ]);

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id);
        $response->assertStatus(200);
    }

    public function test_index()
    {
        $response = $this->get($this->url);
        $response->assertStatus(200);
    }
}
