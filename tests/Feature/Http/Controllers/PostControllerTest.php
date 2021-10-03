<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/posts/";

    private $model;
    private $user;
    private $category;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();

        $this->model = Post::factory()->create();
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'title' => 'abc',
            'body' => 'this is body',
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'title' => 'abc',
            'body' => 'this is body',
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
        ]);

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id);
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
