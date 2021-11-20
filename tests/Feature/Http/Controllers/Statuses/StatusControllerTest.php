<?php

namespace Tests\Feature\Http\Controllers\Statuses;

use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    private array $normalUserHeader;
    private Collection|Model $normalUser;

    public function setUp(): void
    {
        parent::setUp();

        $role = Role::factory()->create(['name' => 'Administrator']);
        $this->user = User::factory()->create();
        $this->user->roles()->attach($role);
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create(['created_by' => $this->user->id, 'category_id' => $this->category->id]);
        $this->model = Status::factory()->create();
        $token = auth()->fromUser($this->user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];

        $role = Role::factory()->create(['name' => 'User']);
        $this->normalUser = User::factory()->create();
        $this->user->roles()->attach($role);
        $normalUserToken = auth()->fromUser($this->normalUser);
        $this->normalUserHeader = [
            'Authorization' => 'bearer ' . $normalUserToken
        ];
    }

    public function test_store_for_admin()
    {
        $response = $this->post($this->url, [
            'name' => 'name 123',
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_show_for_admin()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
        $response->assertStatus(200);
    }

    public function test_update_for_admin()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'name 123',
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_destroy_for_admin()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->header);
        $response->assertStatus(204);
    }

    public function test_update_for_normal_user()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'name 123',
        ], $this->normalUserHeader);

        $response->assertStatus(403);
    }

    public function test_destroy_for_normal_user()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->normalUserHeader);
        $response->assertStatus(403);
    }

    public function test_index()
    {
        $response = $this->get($this->url, $this->header);
        $response->assertStatus(200);
    }
}
