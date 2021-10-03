<?php

namespace Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/comments/";

    private $model;
    /**
     * @var Collection|Model
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->model = Comment::factory()->create();
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id);
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'name' => 'abc',
            'user_id' => $this->user->id
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'test',
            'user_id' => $this->user->id
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
