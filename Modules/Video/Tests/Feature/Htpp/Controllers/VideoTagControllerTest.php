<?php

namespace Modules\Video\Tests\Feature\Htpp\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Tag\Entities\Tag;
use Modules\User\Entities\User;
use Modules\Video\Entities\Video;
use Tests\TestCase;

class VideoTagControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $role;
    /**
     * @var Collection|Model
     */
    private $category;
    /**
     * @var Collection|Model
     */
    private $tag;
    /**
     * @var Collection|Model
     */
    private $post;
    /**
     * @var Collection|Model
     */
    private $video;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->create();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->video = Video::factory()->create([
            'user_id' => $this->user->id,
            'category_id' => $this->category->id]);

        $token = auth()->fromUser($this->user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->videos);
        $response = $this->get('/api/tags/' . $this->tag->id . '/videos', $this->header);
        $response->assertStatus(200);
    }
}
