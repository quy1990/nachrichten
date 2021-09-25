<?php

namespace Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_show()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $response = $this->post('/api/categories', [
            'name' => 'abc'
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $category = Category::factory()->create();

        $response = $this->put('/api/categories/'. $category->id, [
            'name' => 'test'
        ]);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $category = Category::factory()->create();
        $response = $this->delete('/api/categories/' . $category->id);
        $response->assertStatus(204);
    }

    public function test_index()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }
}
