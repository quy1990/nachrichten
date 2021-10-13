<?php

namespace Models;

use App\Models\Category;
use App\Models\Subscribable;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $videos;
    private $subscribedCategories;
    private $taggables;
    private $tag;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $categories = Category::factory(env('TEST_COUNT'))->create();
        $this->tag = Tag::factory()->create();
        $this->videos = Video::factory(env('TEST_COUNT') * 2)->create(['user_id' => $this->testedUser->id, 'category_id' => $categories[0]->id]);

        foreach ($this->videos as $video) {
            $this->subscribedCategories[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $video->id, 'subscribable_type' => 'App\Models\Video']);
        }

        foreach ($this->videos as $video) {
            $this->taggables[] = Taggable::factory()->create(['tag_id' => $this->tag->id, 'taggable_id' => $video->id, 'taggable_type' => 'App\Models\Video']);
        }
    }

    public function testTags()
    {
        $tags = Video::find($this->videos[0]->id)->tags;
        foreach ($tags as $item) {
            $item = $item->getAttributes();
            self::assertEquals($item, $this->tag->getAttributes());
        }
    }

    public function testSubscribers()
    {
        foreach ($this->videos as $video) {
            self::assertEquals($video->subscribers->first()->getAttributes(), $this->testedUser->getAttributes());
        }
    }
}
