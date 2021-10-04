<?php

namespace Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/tags/";

    private $model;
    private array $header;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = Tag::factory()->create();
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
            'name' => 'abc'
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'test'
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
