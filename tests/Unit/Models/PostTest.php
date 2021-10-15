<?php

namespace Models;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Subscribable;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $users;
    private $categories;
    private $posts;
    private $subscribedPosts;
    private $image;
    private $taggables;
    private $tag;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $this->categories = Category::factory(env('TEST_COUNT'))->create();
        $this->users = User::factory(env('TEST_COUNT'))->create();
        $this->posts = Post::factory(env('TEST_COUNT') * 2)->create(['user_id' => $this->testedUser->id, 'category_id' => $this->categories[0]->id]);
        $this->image = Image::factory()->create(['imageable_id' => $this->categories[0]->id, 'imageable_type' => 'App\Models\Category']);
        $this->tag = Tag::factory()->create();

        foreach ($this->posts as $post) {
            $this->subscribedPosts[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $post->id, 'subscribable_type' => 'App\Models\Post']);
        }

        foreach ($this->posts as $post) {
            $this->taggables[] = Taggable::factory()->create(['tag_id' => $this->tag->id, 'taggable_id' => $post->id, 'taggable_type' => 'App\Models\Post']);
        }
    }


    public function testUser()
    {
        $user = Post::where('user_id', $this->testedUser->id)->first()->user;
        self::assertEquals($user->getAttributes(), $this->testedUser->getAttributes());
    }

    public function testCategory()
    {
        $category = Post::where('user_id', $this->testedUser->id)->first()->category;
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
