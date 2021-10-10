<?php

namespace Models;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Role;
use App\Models\Subscribable;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $users;
    private $categories;
    private $videos;
    private $posts;
    private $role;
    private $comment;
    private $subscribedUsers;
    private $subscribedPosts;
    private $subscribedCategories;
    private $subscribedVideos;
    private $image;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = Role::factory()->create();
        $this->testedUser = User::factory()->create();
        $this->testedUser->roles()->attach($this->role->id);
        $this->categories = Category::factory(env('TEST_COUNT'))->create();
        $this->users = User::factory(env('TEST_COUNT'))->create();
        $this->videos = Video::factory(env('TEST_COUNT'))->create(['user_id' => $this->testedUser->id, 'category_id' => $this->categories[0]->id]);
        $this->posts = Post::factory(env('TEST_COUNT') * 2)->create(['user_id' => $this->testedUser->id, 'category_id' => $this->categories[0]->id]);
        $this->comment = Comment::factory()->create(['user_id' => $this->testedUser->id]);
        $this->image = Image::factory()->create(['imageable_id' => $this->testedUser->id, 'imageable_type' => 'App\Models\User']);

        foreach ($this->users as $user) {
            $this->subscribedUsers[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $user->id, 'subscribable_type' => 'App\Models\User']);
        }
        foreach ($this->posts as $post) {
            $this->subscribedPosts[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $post->id, 'subscribable_type' => 'App\Models\Post']);
        }
        foreach ($this->categories as $category) {
            $this->subscribedCategories[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $category->id, 'subscribable_type' => 'App\Models\Category']);
        }
        foreach ($this->videos as $video) {
            $this->subscribedVideos[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $video->id, 'subscribable_type' => 'App\Models\Video']);
        }
    }


    public function testSubscribedUsers()
    {
        $subscribedUsers = Subscribable::select(['user_id', 'subscribable_id', 'subscribable_type'])->where('user_id', $this->testedUser->id)
            ->where('subscribable_type', 'App\Models\User')->get()->toArray();
        foreach ($this->subscribedUsers as $subscribedUser) {
            $subscribedUser = $subscribedUser->getAttributes('user_id', 'subscribable_id', 'subscribable_type');
            unset($subscribedUser['id']);
            self::assertTrue(in_array($subscribedUser, $subscribedUsers));
        }
    }

    public function testImage()
    {
        $testedUserId = $this->testedUser->id;
        $image = User::find($testedUserId)->image;
        self::assertEquals($this->image->getAttributes(), $image->getAttributes());
    }

    public function testComments()
    {
        $idTestedUser = $this->testedUser->id;
        $comment = User::find($idTestedUser)->comments()->first();
        self::assertEquals($this->comment->getAttributes(), $comment->getAttributes());
    }

    public function testRoles()
    {
        $idTestedUser = $this->testedUser->id;
        $role = User::find($idTestedUser)->roles()->first();
        self::assertEquals($this->role->getAttributes(), $role->getAttributes());
    }

    public function testSubscribedVideos()
    {
        $subscribedVideos = Subscribable::select(['user_id', 'subscribable_id', 'subscribable_type'])->where('user_id', $this->testedUser->id)
            ->where('subscribable_type', 'App\Models\Video')->get()->toArray();
        foreach ($this->subscribedVideos as $item) {
            $item = $item->getAttributes('user_id', 'subscribable_id', 'subscribable_type');
            unset($item['id']);
            self::assertTrue(in_array($item, $subscribedVideos));
        }
    }

    public function testSubscribedCategories()
    {
        $subscribedCategories = Subscribable::select(['user_id', 'subscribable_id', 'subscribable_type'])->where('user_id', $this->testedUser->id)
            ->where('subscribable_type', 'App\Models\Category')->get()->toArray();
        foreach ($this->subscribedCategories as $item) {
            $item = $item->getAttributes('user_id', 'subscribable_id', 'subscribable_type');
            unset($item['id']);
            self::assertTrue(in_array($item, $subscribedCategories));
        }
    }

    public function testSubscribers()
    {
        $subscribedUsers = Subscribable::select(['user_id', 'subscribable_id', 'subscribable_type'])->where('user_id', $this->testedUser->id)
            ->where('subscribable_type', 'App\Models\User')->get()->toArray();
        foreach ($this->subscribedUsers as $item) {
            $item = $item->getAttributes('user_id', 'subscribable_id', 'subscribable_type');
            unset($item['id']);
            self::assertTrue(in_array($item, $subscribedUsers));
        }
    }

    public function testSubscribedPosts()
    {
        $subscribedPosts = Subscribable::select(['user_id', 'subscribable_id', 'subscribable_type'])->where('user_id', $this->testedUser->id)
            ->where('subscribable_type', 'App\Models\Post')->get()->toArray();
        foreach ($this->subscribedPosts as $item) {
            $item = $item->getAttributes('user_id', 'subscribable_id', 'subscribable_type');
            unset($item['id']);
            self::assertTrue(in_array($item, $subscribedPosts));
        }
    }

    public function testPosts()
    {
        self::assertEquals($this->posts->toArray(), $this->testedUser->posts->toArray());
    }
}
