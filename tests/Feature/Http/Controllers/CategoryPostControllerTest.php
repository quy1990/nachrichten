<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryPostControllerTest extends TestCase
{
    use DatabaseMigrations;

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
        Post::factory(10)->create([
            'category_id' => $this->category->id,
            'user_id' => $this->user->id,
        ]);
        $response = $this->get('/api/categories/' . $this->category->id . '/posts');
        $response->assertStatus(200);
    }
}
