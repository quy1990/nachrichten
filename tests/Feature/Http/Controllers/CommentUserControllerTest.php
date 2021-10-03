<?php

namespace Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CommentUserControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $comment;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->comment = Comment::factory(5)->create(['user_id' => $this->user->id]);
    }

    public function test__invoke()
    {
        $response = $this->get('/api/users/' . $this->user->id . '/comments');
        $response->assertStatus(200);
    }
}
