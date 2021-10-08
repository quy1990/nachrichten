<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subscribable;
use App\Models\User;
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
        $category = Category::factory()->create();
        $posts = Post::factory(10)->create(['category_id' => $category->id]);
        foreach ($posts as $post) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $post->id, 'subscribable_type' => 'App\Models\Post']);
        }
        $response = $this->get($this->url . $this->user->id . '/subscribes', [
            'Authorization' => 'bearer ' . $this->token
        ]);


        $response->assertStatus(200);
    }
}
