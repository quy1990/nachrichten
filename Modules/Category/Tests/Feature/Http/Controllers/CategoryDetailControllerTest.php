<?php

namespace Modules\Category\Tests\Feature\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Tests\TestCase;

class CategoryDetailControllerTest extends TestCase
{
    use RefreshDatabase;

    private $url = '/api/categoriesDetail';

    private $tag;
    private $video;
    private $post;
    private $taggable;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Post::factory(5)->create([
            'created_by'  => $user->id,
            'category_id' => $category->id,
        ]);
    }

    public function test__invoke()
    {
        $response = $this->get($this->url);
        $response->assertStatus(200);
    }
}
