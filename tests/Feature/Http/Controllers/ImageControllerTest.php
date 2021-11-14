<?php

namespace Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/images/";

    private $model;
    private array $arr;
    private $post;
    private array $header;

    public function setUp(): void
    {
        parent::setUp();
        $this->arr = ['App\Models\Post', 'App\Models\User'];
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $this->post = Post::factory()->create(['category_id' => $category->id]);
        $this->model = Image::factory()->create([
            'imageable_id' => 1,
            'imageable_type' => $this->arr[rand(0, 1)]]);

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
            'url' => 'https://via.placeholder.com/640x480.png/00aa99',
            'imageable_id' => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'url' => 'https://via.placeholder.com/640x480.png/00aa99',
            'imageable_id' => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
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
