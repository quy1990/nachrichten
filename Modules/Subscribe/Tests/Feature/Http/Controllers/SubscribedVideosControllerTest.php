<?php

namespace Modules\Subscribe\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Subscribe\Entities\Subscribable;
use Modules\User\Entities\User;
use Modules\Video\Entities\Video;
use Tests\TestCase;


class SubscribedVideosControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/users/subscribed-videos";

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
    private $videos;

    public function setUp(): void
    {
        parent::setUp();
        $this->user1 = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->videos = Video::factory(env('TEST_COUNT'))->create();
        foreach ($this->videos as $video) {
            Subscribable::factory()->create(['user_id' => $this->user1->id, 'subscribable_id' => $video->id, 'subscribable_type' => 'Modules\Video\Entities\Video']);
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
