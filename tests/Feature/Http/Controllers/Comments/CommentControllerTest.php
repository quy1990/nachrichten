<?php

namespace Http\Controllers\Comments;

use App\Models\Comment;
use App\Models\Role;
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
    /**
     * @var string[]
     */
    private array $header;
    private Collection|Model $normalUser;
    /**
     * @var string[]
     */
    private array $normalUserHeader;

    public function setUp(): void
    {
        parent::setUp();
        $role = Role::factory()->create(['name' => 'Administrator']);
        $this->user = User::factory()->create();
        $this->user->roles()->attach($role);
        $this->model = Comment::factory()->create();

        $token = auth()->fromUser($this->user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];

        $role = Role::factory()->create(['name' => 'User']);
        $this->normalUser = User::factory()->create();
        $this->normalUser->roles()->attach($role);
        $normalUserToken = auth()->fromUser($this->normalUser);
        $this->normalUserHeader = [
            'Authorization' => 'bearer ' . $normalUserToken
        ];
    }

    public function test_store_for_admin()
    {
        $response = $this->post($this->url, [
            'body'    => 'body',
            'user_id' => $this->user->id
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update_for_admin()
    {
        $response = $this->put($this->url . $this->model->id, [
            'body'    => 'body',
            'user_id' => $this->user->id
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_destroy_for_admin()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->header);
        $response->assertStatus(204);
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
        $response->assertStatus(200);
    }

    public function test_store_for_normal_user()
    {
        $response = $this->post($this->url, [
            'body'    => 'body',
            'user_id' => $this->normalUser->id
        ], $this->normalUserHeader);

        $response->assertStatus(201);
    }

    public function test_update_for_normal_user()
    {
        $response = $this->put($this->url . $this->model->id, [
            'body' => 'body'
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
