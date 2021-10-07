<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Subscribe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscribeControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/subscribes/";

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $role;
    /**
     * @var Collection|Model
     */
    private $post;
    /**
     * @var Collection|Model
     */
    private $tag;
    /**
     * @var Collection|Model
     */
    private $video;
    /**
     * @var Collection|Model
     */
    private $category;
    /**
     * @var Collection|Model
     */
    private $comment;
    /**
     * @var Collection|Model
     */
    private $subscribe;
    /**
     * @var string[]
     */
    private array $header;
    /**
     * @var Collection|Model
     */
    private $user2;
    /**
     * @var Collection|Model
     */
    private $user1;

    public function setUp(): void
    {
        parent::setUp();
        $this->user1 = User::factory()->create();
        $this->tag = Tag::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create();
        $this->video = Video::factory()->create();
        $this->comment = Comment::factory()->create();
        $this->subscribe = Subscribe::factory()->create(['user_id' => $this->user1->id]);

        $this->user2 = User::factory()->create();
        $token = auth()->fromUser($this->user1);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test_store_with_non_login_user()
    {
        $response = $this->post($this->url, [
            'subscribable_id' => $this->post->id,
            'subscribable_type' => 'App\Models\Post',
        ]);
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $response = $this->post($this->url, [
            'subscribable_id' => $this->post->id,
            'subscribable_type' => 'App\Models\Post',
        ], $this->header);
        $response->assertStatus(201);
    }

    public function testDestroy()
    {
        $response = $this->delete($this->url . $this->subscribe->id, [], $this->header);
        $response->assertStatus(204);
    }
}
