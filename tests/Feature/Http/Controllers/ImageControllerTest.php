<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    use DatabaseMigrations;

    private string $url = "/api/images/";

    private $model;
    /**
     * @var string[]
     */
    private array $arr;
    /**
     * @var Collection|Model
     */
    private $user;
    private $post;
    /**
     * @var Collection|Model
     */
    private $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->arr = ['App\Models\Post', 'App\Models\User'];
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create(['category_id' => $this->category->id]);
        $this->model = Image::factory()->create([
            'imageable_id' => 1,
            'imageable_type' => $this->arr[rand(0, 1)]]);
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id);
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'url' => 'https://via.placeholder.com/640x480.png/00aa99',
            'imageable_id' => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'url' => 'https://via.placeholder.com/640x480.png/00aa99',
            'imageable_id' => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
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
