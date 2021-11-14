<?php

namespace Modules\Post\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Tag\Entities\Tag;
use Modules\User\Entities\User;
use Tests\TestCase;

class PostTagControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $role;
    /**
     * @var Collection|Model
     */
    private $tag;
    /**
     * @var Collection|Model
     */
    private $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->create();
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $this->post = Post::factory()->create([
            'category_id' => $category->id,
            'created_by'  => $user->id]);
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->posts);
        $response = $this->get('/api/tags/' . $this->tag->id . '/posts');
        $response->assertStatus(200);
    }
}
