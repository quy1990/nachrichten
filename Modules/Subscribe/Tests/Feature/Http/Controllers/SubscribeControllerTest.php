<?php

namespace Modules\Subscribe\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Comment\Entities\Comment;
use Modules\Post\Entities\Post;
use Modules\Subscribe\Entities\Subscribable;
use Modules\Tag\Entities\Tag;
use Modules\User\Entities\User;
use Modules\Video\Entities\Video;
use Tests\TestCase;

class SubscribeControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/subscribe";
    private string $url_unsubscribes = "/api/unsubscribe";

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
    private $subscribable;
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
        $this->subscribable = Subscribable::factory()->create(['user_id' => $this->user1->id]);

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
            'subscribable_type' => 'Modules\Post\Entities\Post',
        ]);
        $response->assertStatus(500);
    }

    public function testStore()
    {
        $user1 = User::factory()->create();
        $post = Post::factory()->create();
        $token = auth()->fromUser($user1);
        $header = [
            'Authorization' => 'bearer ' . $token
        ];

        $response = $this->post($this->url, [
            'user_id'           => $user1->id,
            'subscribable_id'   => $post->id,
            'subscribable_type' => 'Modules\Post\Entities\Post',
        ], $header);

        $response->assertStatus(201);
    }

    public function testDestroy()
    {
        $user1 = User::factory()->create();

        $token = auth()->fromUser($user1);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];

        Subscribable::factory()->create([
            'user_id' => $user1->id,
            'subscribable_id' => $this->post->id,
            'subscribable_type' => 'Modules\Post\Entities\Post']);

        $response = $this->post($this->url_unsubscribes, [
            'user_id'           => $user1->id,
            'subscribable_id'   => $this->post->id,
            'subscribable_type' => 'Modules\Post\Entities\Post'
        ], $this->header);

        $response->assertStatus(204);
    }
}
