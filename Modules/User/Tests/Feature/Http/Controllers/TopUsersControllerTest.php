<?php

namespace Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Comment\Entities\Comment;
use Modules\Comment\Entities\User;
use Tests\TestCase;

class TopUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    private array $header;

    public function setUp(): void
    {
        parent::setUp();
        User::factory(env('TEST_COUNT'))->create();
        $user = User::factory()->create();
        Comment::factory(env('TEST_COUNT'))->create(['user_id' => $user->id]);
        $token = auth()->fromUser($user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test__invoke()
    {
        $response = $this->get('/api/top-users', $this->header);
        $response->assertStatus(200);
    }
}
