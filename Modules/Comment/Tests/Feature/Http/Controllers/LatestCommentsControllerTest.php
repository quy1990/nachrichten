<?php

namespace Modules\Comment\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Comment\Entities\Comment;
use Modules\Post\Entities\Post;
use Modules\Image\Entities\Tag;
use Modules\User\Entities\User;
use Tests\TestCase;

class LatestCommentsControllerTest extends TestCase
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
        $response = $this->get('/api/latest-comments', $this->header);
        $response->assertStatus(200);
    }
}
