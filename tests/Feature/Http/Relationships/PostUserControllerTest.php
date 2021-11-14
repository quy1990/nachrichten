<?php

namespace Http\Relationships;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\Post;
use Modules\Category\Entities\User;
use Tests\TestCase;

class PostUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $post;
    /**
     * @var Collection|Model
     */
    private $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create(['created_by' => $this->user->id]);
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->posts);
    }
}
