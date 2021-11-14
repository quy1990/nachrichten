<?php

namespace Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Comment;
use Modules\Category\Entities\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $comments;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $this->comments = Comment::factory(env('TEST_COUNT'))->create(['user_id' => $this->testedUser->id]);
    }

    public function testUser()
    {
        $comments = Comment::where('user_id', $this->testedUser->id)->get();
        foreach ($comments->toArray() as $item) {
            self::assertTrue(in_array($item, $this->comments->toArray()));
        }
    }

}
