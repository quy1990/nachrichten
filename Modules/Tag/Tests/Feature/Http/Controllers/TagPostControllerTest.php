<?php

namespace Modules\Tag\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Tag\Entities\Tag;
use Modules\Tag\Entities\Taggable;
use Modules\User\Entities\User;
use Modules\Video\Entities\Video;
use Tests\TestCase;

class TagPostControllerTest extends TestCase
{
    use RefreshDatabase;

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
    private $header;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->create();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->video = Video::factory()->create();
        $this->post = Post::factory()->create([
            'created_by'  => $this->user->id,
            'category_id' => $this->category->id,
        ]);

        $this->taggable = Taggable::factory()->create(['tag_id' => $this->tag->id, 'taggable_id' => $this->post->id, 'taggable_type' => 'Modules\Post\Entities\Post']);
        $user = User::factory()->create();
        $token = auth()->fromUser($user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->video->tags);
        $response = $this->get('/api/posts/' . $this->post->id . '/tags', $this->header);
        $response->assertStatus(200);
    }
}
