<?php

namespace Models;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subscribable;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $videos;
    private $taggables;
    private $tag;
    private $posts;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $categories = Category::factory(env('TEST_COUNT'))->create();
        $this->tag = Tag::factory()->create();
        $this->videos = Video::factory(env('TEST_COUNT') * 2)->create(['user_id' => $this->testedUser->id, 'category_id' => $categories[0]->id]);
        $this->posts = Post::factory(env('TEST_COUNT') * 2)->create(['user_id' => $this->testedUser->id, 'category_id' => $categories[0]->id]);

        foreach ($this->videos as $video) {
            $this->taggables[] = Taggable::factory()->create(['tag_id' => $this->tag->id, 'taggable_id' => $video->id, 'taggable_type' => 'App\Models\Video']);
        }

        foreach ($this->posts as $post) {
            $this->taggables[] = Taggable::factory()->create(['tag_id' => $this->tag->id, 'taggable_id' => $post->id, 'taggable_type' => 'App\Models\Post']);
        }

        Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $this->tag->id, 'subscribable_type' => 'App\Models\Tag']);

    }

    public function testPosts()
    {
        $tags = Post::find($this->posts[0]->id)->tags;
        foreach ($tags as $item) {
            $item = $item->getAttributes();
            self::assertEquals($item, $this->tag->getAttributes());
        }
    }

    public function testVideos()
    {
        $tags = Video::find($this->videos[0]->id)->tags;
        foreach ($tags as $item) {
            $item = $item->getAttributes();
            self::assertEquals($item, $this->tag->getAttributes());
        }
    }

    public function testSubscribers()
    {
        $tag = Tag::find($this->tag->id);
        self::assertEquals($tag->subscribers->first()->getAttributes(), $this->testedUser->getAttributes());
    }
}
