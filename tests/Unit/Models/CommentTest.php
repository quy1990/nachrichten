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

class CommentTest extends TestCase
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
    private $comments;

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
        $this->image = Image::factory()->create(['imageable_id' => $this->testedUser->id, 'imageable_type' => 'App\Models\User']);
        $this->comments = Comment::factory(env('TEST_COUNT'))->create(['user_id' => $this->testedUser->id]);

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

    public function testUser()
    {
        $comments = Comment::where('user_id', $this->testedUser->id)->get();
        foreach ($comments->toArray() as $item) {
            self::assertTrue(in_array($item, $this->comments->toArray()));
        }
    }

}
