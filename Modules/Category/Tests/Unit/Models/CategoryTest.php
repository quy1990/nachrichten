<?php

namespace Modules\Category\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Image\Entities\Subscribable;
use Modules\User\Entities\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $testedUser;
    private $users;
    private $categories;
    private $posts;
    private $subscribedCategories;

    public function setUp(): void
    {
        parent::setUp();
        $this->testedUser = User::factory()->create();
        $this->categories = Category::factory(env('TEST_COUNT'))->create();
        $this->users = User::factory(env('TEST_COUNT'))->create();
        $this->posts = Post::factory(env('TEST_COUNT') * 2)->create(['created_by' => $this->testedUser->id, 'category_id' => $this->categories[0]->id]);

        foreach ($this->categories as $category) {
            $this->subscribedCategories[] = Subscribable::factory()->create(['user_id' => $this->testedUser->id, 'subscribable_id' => $category->id, 'subscribable_type' => 'App\Models\Category']);
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

    public function testPosts()
    {
        $testingPosts = Category::find($this->categories[0]->id)->posts;
        self::assertSame($this->categories[0]->posts->toArray(), $testingPosts->toArray());
    }
}
