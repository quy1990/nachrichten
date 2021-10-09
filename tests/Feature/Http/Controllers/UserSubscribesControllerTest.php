<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\Subscribable;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSubscribesControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/users/";

    private $user;

    private $token;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = auth()->fromUser($this->user);
    }

    public function test_GetSubscribes()
    {
        $role = Role::factory()->create();
        $categories = Category::factory(5)->create();
        $users = User::factory(5)->create();
        $videos = Video::factory(5)->create(['user_id' => $this->user->id, 'category_id' => $categories[0]->id]);
        $posts = Post::factory(10)->create(['category_id' => $categories[0]->id]);
        foreach ($users as $user) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $user->id, 'subscribable_type' => 'App\Models\User']);
        }
        foreach ($posts as $post) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $post->id, 'subscribable_type' => 'App\Models\Post']);
        }
        foreach ($categories as $category) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $category->id, 'subscribable_type' => 'App\Models\Category']);
        }
        foreach ($videos as $video) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $video->id, 'subscribable_type' => 'App\Models\Video']);
        }

        $response = $this->get($this->url . $this->user->id . '/subscribes', [
            'Authorization' => 'bearer ' . $this->token
        ]);

        $response->assertStatus(200);
    }
}
