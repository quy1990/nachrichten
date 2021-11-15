<?php
namespace Modules\Video\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Mockery;
use Modules\Category\Entities\Category;
use Modules\Subscribe\Entities\Subscribable;
use Modules\Tag\Entities\Tag;
use Modules\Tag\Entities\Taggable;
use Modules\Video\Entities\Video;
use Modules\User\Entities\User;
use Modules\Video\Observers\VideoObserver;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $videos;
    private $subscribedCategories;
    private $taggables;
    private $tag;
    private $categories;
    private $users;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $this->users = User::factory(env('TEST_COUNT'))->create();
        $this->categories = Category::factory(env('TEST_COUNT'))->create();
        $this->tag = Tag::factory()->create();

        foreach ($this->users as $user) {
            Subscribable::factory()->create(['user_id' => $user->id, 'subscribable_id' => $this->testedUser->id, 'subscribable_type' => 'Modules\User\Entities\User']);
            Subscribable::factory()->create(['user_id' => $user->id, 'subscribable_id' => $this->categories[0]->id, 'subscribable_type' => 'App\Models\Category']);
        }

        $this->videos = Video::factory(env('TEST_COUNT') * 2)->create(['user_id' => $this->testedUser->id, 'category_id' => $this->categories[0]->id]);

        foreach ($this->videos as $video) {
            $this->subscribedCategories[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $video->id, 'subscribable_type' => 'Modules\Video\Entities\Video']);
        }

        foreach ($this->videos as $video) {
            $this->taggables[] = Taggable::factory()->create(['tag_id' => $this->tag->id, 'taggable_id' => $video->id, 'taggable_type' => 'Modules\Video\Entities\Video']);
        }
    }

    public function testSendMailToSubscribers()
    {
        User::find($this->testedUser->id);
        $model = new Video();
        $videoObserver = Mockery::mock(VideoObserver::class);
        $videoObserver->shouldReceive('created')->once();
        App::instance(VideoObserver::class, $videoObserver);

        $model->video_path = 'new_path';
        $model->title = 'new_title';
        $model->body = 'new_body';
        $model->user_id = $this->testedUser->id;
        $model->category_id = $this->categories[0]->id;
        $model->save();
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
