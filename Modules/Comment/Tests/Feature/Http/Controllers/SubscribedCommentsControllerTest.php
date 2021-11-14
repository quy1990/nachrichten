<?php

namespace Modules\Comment\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Comment\Entities\Comment;
use Modules\Image\Entities\Subscribable;
use Modules\Image\Entities\User;
use Tests\TestCase;

class SubscribedCommentsControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/users-subscribed-comments";

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
    /**
     * @var Collection|Model
     */
    private $posts;
    /**
     * @var Collection|Model
     */
    private Collection|Model $comments;

    public function setUp(): void
    {
        parent::setUp();
        $this->user1 = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->comments = Comment::factory(env('TEST_COUNT'))->create();
        foreach ($this->comments as $item) {
            Subscribable::factory()->create(['user_id' => $this->user1->id, 'subscribable_id' => $item->id, 'subscribable_type' => 'App\Models\Comment']);
        }

        $token = auth()->fromUser($this->user1);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test__invoke()
    {
        $response = $this->get($this->url, $this->header);
        $response->assertStatus(200);
    }
}
