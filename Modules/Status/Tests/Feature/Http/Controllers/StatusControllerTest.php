<?php

namespace Modules\Status\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Status\Entities\Status;
use Modules\User\Entities\User;
use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/statuses/";

    private $model;
    private $user;
    private $category;
    private $status;
    private array $header;
    private $post;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create(['created_by' => $this->user->id, 'category_id' => $this->category->id]);
        $this->model = Status::factory()->create();
        $token = auth()->fromUser($this->user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'name' => 'name 123',
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'name 123',
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
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
