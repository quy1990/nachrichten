<?php

namespace Http\Controllers\DashBroad;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashBroadControllerTest extends TestCase
{
    use RefreshDatabase;

    private array $header;
    private $normalUser;
    private array $normalUserHeader;

    public function setUp(): void
    {
        parent::setUp();
        User::factory(env('TEST_COUNT'))->create();
        Tag::factory(env('TEST_COUNT'))->create();
        Category::factory(env('TEST_COUNT'))->create();
        Post::factory(env('TEST_COUNT'))->create();

        $role = Role::factory()->create(['name' => 'Administrator']);
        $user = User::factory()->create();
        $user->roles()->attach($role);

        Comment::factory(env('TEST_COUNT'))->create(['user_id' => $user->id]);
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

    public function test__invoke_for_admin()
    {
        $response = $this->get('/api/dash-broad', $this->header);
        $response->assertStatus(200);
    }

    public function test__invoke_for_not_admin()
    {
        $response = $this->get('/api/dash-broad', $this->normalUserHeader);
        $response->assertStatus(403);
    }
}


