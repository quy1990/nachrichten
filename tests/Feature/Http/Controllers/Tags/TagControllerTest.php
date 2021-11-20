<?php

namespace Http\Controllers\Tags;

use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/tags/";

    private $model;
    private array $header;
    private Collection|Model $normalUser;
    /**
     * @var string[]
     */
    private array $normalUserHeader;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = Tag::factory()->create();
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'Administrator']);
        $user->roles()->attach($role);
        $token = auth()->fromUser($user);
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

    public function test_show_for_admin()
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

    public function test_update_for_admin()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'test'
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_update_for_normal_user()
    {
        $response = $this->put($this->url . $this->model->id, [
            'name' => 'test'
        ], $this->normalUserHeader);

        $response->assertStatus(403);
    }

    public function test_destroy_for_admin()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->header);
        $response->assertStatus(204);
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
