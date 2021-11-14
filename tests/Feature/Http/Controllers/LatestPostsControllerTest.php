<?php

namespace Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Tests\TestCase;

class LatestPostsControllerTest extends TestCase
{
    use RefreshDatabase;

    private array $header;

    public function setUp(): void
    {
        parent::setUp();
        User::factory(env('TEST_COUNT'))->create();
        Tag::factory(env('TEST_COUNT'))->create();
        Category::factory(env('TEST_COUNT'))->create();
        Post::factory(env('TEST_COUNT'))->create();
        $user = User::factory()->create();
        Comment::factory(env('TEST_COUNT'))->create(['user_id' => $user->id]);
        $token = auth()->fromUser($user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test__invoke()
    {
        $response = $this->get('/api/latest-posts', $this->header);
        $response->assertStatus(200);
    }
}
