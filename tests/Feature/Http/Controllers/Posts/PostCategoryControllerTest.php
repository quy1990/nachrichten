<?php

namespace Http\Controllers\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    public function test__invoke()
    {
        $status = Status::factory()->create();
        Post::factory(10)->create([
            'status_id'   => $status->id,
            'category_id' => $this->category->id,
            'created_by'  => $this->user->id,
        ]);
        $response = $this->get('/api/categories/' . $this->category->id . '/posts');
        $response->assertStatus(200);
    }
}
