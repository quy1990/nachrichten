<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TagPostControllerTest extends TestCase
{
    use DatabaseMigrations;

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
    private $post;
    /**
     * @var Collection|Model
     */
    private $taggable;
    /**
     * @var Collection|Model
     */
    private $category;
    /**
     * @var Collection|Model
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->create();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->video = Video::factory()->create();
        $this->post = Post::factory()->create([
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
        ]);

        $this->taggable = Taggable::factory()->create();
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->video->tags);
        $response = $this->get('/api/posts/' . $this->post->id . '/tags');
        $response->assertStatus(200);
    }
}
