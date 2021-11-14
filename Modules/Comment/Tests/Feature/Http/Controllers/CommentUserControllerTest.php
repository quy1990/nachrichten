<?php

namespace Modules\Comment\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Comment\Entities\Comment;
use Modules\Image\Entities\User;
use Tests\TestCase;

class CommentUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $comment;
    /**
     * @var string[]
     */
    private array $header;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->comment = Comment::factory(5)->create(['user_id' => $this->user->id]);
        $user = User::factory()->create();
        $token = auth()->fromUser($user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test__invoke()
    {
        $response = $this->get('/api/users/' . $this->user->id . '/comments', $this->header);
        $response->assertStatus(200);
    }
}
