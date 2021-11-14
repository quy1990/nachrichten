<?php

namespace Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Image\Entities\Post;
use Modules\Image\Entities\Subscribable;
use Modules\Image\Entities\User;
use Modules\Image\Entities\Video;
use Tests\TestCase;

class UserSubscribesControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/users/";

    private $user;

    private $token;
    private $users;
    private $categories;
    private $videos;
    private $posts;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = auth()->fromUser($this->user);

        $this->categories = Category::factory(5)->create();
        $this->users = User::factory(5)->create();
        $this->videos = Video::factory(5)->create(['user_id' => $this->user->id, 'category_id' => $this->categories[0]->id]);
        $this->posts = Post::factory(10)->create(['category_id' => $this->categories[0]->id]);
        foreach ($this->users as $user) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $user->id, 'subscribable_type' => 'App\Models\User']);
        }
        foreach ($this->posts as $post) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $post->id, 'subscribable_type' => 'App\Models\Post']);
        }
        foreach ($this->categories as $category) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $category->id, 'subscribable_type' => 'App\Models\Category']);
        }
        foreach ($this->videos as $video) {
            Subscribable::factory()->create(['user_id' => $this->user->id, 'subscribable_id' => $video->id, 'subscribable_type' => 'App\Models\Video']);
        }
    }

    public function test_get_subscribes()
    {
        $response = $this->get($this->url . $this->user->id . '/subscribes', [
            'Authorization' => 'bearer ' . $this->token
        ]);

        $response->assertStatus(200);
    }
}
