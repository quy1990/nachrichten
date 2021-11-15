<?php

namespace Modules\Subscribe\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Subscribe\Entities\Subscribable;
use Modules\User\Entities\User;
use Tests\TestCase;


class SubscribedUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/users/subscribed-users";

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
    private $users;

    public function setUp(): void
    {
        parent::setUp();
        $this->user1 = User::factory()->create();
        $this->users = User::factory(env('TEST_COUNT'))->create();
        foreach ($this->users as $item) {
            Subscribable::factory()->create(['user_id' => $this->user1->id, 'subscribable_id' => $item->id, 'subscribable_type' => 'Modules\User\Entities\User']);
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
