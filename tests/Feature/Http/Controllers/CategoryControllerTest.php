<?php

namespace Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    private string $url = "/api/categories/";

    private $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = Category::factory()->create();
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id);
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'name' => 'abc'
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'test'
        ]);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $response = $this->delete($this->url . $this->model->id);
        $response->assertStatus(204);
    }

    public function test_index()
    {
        $response = $this->get($this->url);
        $response->assertStatus(200);
    }
}
