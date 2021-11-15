<?php
namespace Modules\Post\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Mockery;
use Modules\Category\Entities\Category;
use Modules\Image\Entities\Image;
use Modules\Post\Entities\Post;
use Modules\Status\Entities\Status;
use Modules\Subscribe\Entities\Subscribable;
use Modules\Tag\Entities\Tag;
use Modules\Tag\Entities\Taggable;
use Modules\User\Entities\User;
use Modules\Post\Observers\PostObserver;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $categories;
    private $posts;
    private $subscribedPosts;
    private $image;
    private $taggables;
    private $tag;
    private $users;
    private $status;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $this->categories = Category::factory(env('TEST_COUNT'))->create();
        $this->users = User::factory(env('TEST_COUNT'))->create();
        $this->posts = Post::factory(env('TEST_COUNT') * 2)->create(['created_by' => $this->testedUser->id, 'category_id' => $this->categories[0]->id]);
        $this->image = Image::factory()->create(['imageable_id' => $this->categories[0]->id, 'imageable_type' => 'App\Models\Category']);
        $this->tag = Tag::factory()->create();
        $this->status = Status::factory()->create();

        foreach ($this->posts as $post) {
            $this->subscribedPosts[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $post->id, 'subscribable_type' => 'Modules\Post\Entities\Post']);
        }

        foreach ($this->users as $user) {
            Subscribable::factory()->create(['user_id' => $user->id, 'subscribable_id' => $this->testedUser->id, 'subscribable_type' => 'Modules\User\Entities\User']);
        }

        foreach ($this->posts as $post) {
            $this->taggables[] = Taggable::factory()->create(['tag_id' => $this->tag->id, 'taggable_id' => $post->id, 'taggable_type' => 'Modules\Post\Entities\Post']);
        }
    }


    public function testUser()
    {
        $user = Post::where('created_by', $this->testedUser->id)->first()->user;
        self::assertEquals($user->getAttributes(), $this->testedUser->getAttributes());
    }

    public function testCategory()
    {
        $category = Post::where('created_by', $this->testedUser->id)->first()->category;
        self::assertEquals($category->getAttributes(), $this->categories[0]->getAttributes());
    }

    public function testImage()
    {
        $image = Image::where('imageable_id', $this->categories[0]->id)
            ->where('imageable_type', 'App\Models\Category')
            ->first();
        self::assertEquals($image->getAttributes(), $this->image->getAttributes());
    }

    public function testTags()
    {
        $tags = Post::find($this->posts[0]->id)->tags;
        foreach ($tags as $item) {
            $item = $item->getAttributes();
            self::assertEquals($item, $this->tag->getAttributes());
        }
    }

    public function testSubscribers()
    {
        foreach ($this->posts as $post) {
            self::assertEquals($post->subscribers->first()->getAttributes(), $this->testedUser->getAttributes());
        }
    }

    public function testPosts()
    {
        $testingPosts = Post::where('category_id', $this->categories[0]->id)->get();
        $item_1 = [];
        foreach ($testingPosts as $item) {
            $item_1[] = $item->getAttributes();
        }
        $item_2 = [];
        foreach ($testingPosts as $item) {
            $item_2[] = $item->getAttributes();
        }
        self::assertSame($item_1, $item_2);
    }
}
