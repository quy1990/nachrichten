<?php

namespace Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\Post;
use Modules\Category\Entities\Status;
use Modules\Category\Entities\User;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    private $categories;
    private $posts;
    private $users;
    private $status;
    private $testedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $this->categories = Category::factory(env('TEST_COUNT'))->create();
        $this->users = User::factory(env('TEST_COUNT'))->create();
        $this->status = Status::factory()->create();
        $this->posts = Post::factory(env('TEST_COUNT') * 2)->create([
            'created_by'  => $this->testedUser->id,
            'category_id' => $this->categories[0]->id,
            'status_id'   => $this->status->id
        ]);
    }

    public function testUser()
    {
        $status = Post::where('status_id', $this->status->id)->first()->status;
        self::assertEquals($status->getAttributes(), $this->status->getAttributes());
    }
}
