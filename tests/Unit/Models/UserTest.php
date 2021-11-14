<?php

namespace Models;

use App\Observers\UserObserver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Mockery;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\Comment;
use Modules\Category\Entities\Image;
use Modules\Category\Entities\Post;
use Modules\Category\Entities\Role;
use Modules\Category\Entities\Subscribable;
use Modules\Category\Entities\User;
use Modules\Category\Entities\Video;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
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
        $categories = Category::factory(env('TEST_COUNT'))->create();
        $users = User::factory(env('TEST_COUNT'))->create();
        $videos = Video::factory(env('TEST_COUNT'))->create(['user_id' => $this->testedUser->id, 'category_id' => $categories[0]->id]);
        $posts = Post::factory(env('TEST_COUNT') * 2)->create(['created_by' => $this->testedUser->id, 'category_id' => $categories[0]->id]);
        $this->comment = Comment::factory()->create(['user_id' => $this->testedUser->id]);
        $this->image = Image::factory()->create(['imageable_id' => $this->testedUser->id, 'imageable_type' => 'App\Models\User']);

        foreach ($users as $user) {
            $this->subscribedUsers[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $user->id, 'subscribable_type' => 'App\Models\User']);
        }
        foreach ($posts as $post) {
            $this->subscribedPosts[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $post->id, 'subscribable_type' => 'App\Models\Post']);
        }
        foreach ($categories as $category) {
            $this->subscribedCategories[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $category->id, 'subscribable_type' => 'App\Models\Category']);
        }
        foreach ($videos as $video) {
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
        $images = User::find($testedUserId)->images;
        self::assertEquals($this->image->getAttributes(), $images->getAttributes());
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
        $posts = Post::where('created_by', $this->testedUser->id)->get();
        self::assertSame($this->testedUser->posts->toArray(), $posts->toArray());
    }

    public function testCreateUserObserver()
    {
        $user = new User();
        $userObserver = Mockery::mock(UserObserver::class);
        $userObserver->shouldReceive('created')->once();
        App::instance(UserObserver::class, $userObserver);

        $user->name = "newname";
        $user->email = "asdasd@dsd.com";
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = Str::random(10);
        $user->save();
    }

    public function testUpdateUserObserver()
    {
        $userObserver = Mockery::mock(UserObserver::class);
        $userObserver->shouldReceive('updated')->once();
        App::instance(UserObserver::class, $userObserver);
        $user = User::first();
        $user->name = "newname_123";
        $user->save();
    }
}
