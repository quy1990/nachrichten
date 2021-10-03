<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageableImageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $role;
    /**
     * @var Collection|Model
     */
    private $category;
    /**
     * @var Collection|Model
     */
    private $tag;
    /**
     * @var Collection|Model
     */
    private $post;
    /**
     * @var Collection|Model
     */
    private $image1;
    /**
     * @var Collection|Model
     */
    private $image2;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = Category::factory()->create();
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create([
            'category_id' => $this->category->id,
            'user_id' => $this->user->id]);

        $this->image1 = Image::factory()->create([
            'imageable_id' => $this->user->id,
            'imageable_type' => 'App\Models\User',
        ]);

        $this->image2 = Image::factory()->create([
            'imageable_id' => $this->post->id,
            'imageable_type' => 'App\Models\Post',
        ]);
    }

    public function test__invoke()
    {
        $response = $this->get('/api/images/' . $this->image1->id . '/imageable');
        $response->assertStatus(200);

        $response = $this->get('/api/images/' . $this->image2->id . '/imageable');
        $response->assertStatus(200);
    }

    public function test_fail_invoke()
    {
        $response = $this->get('/api/images/100/imageable');
        $response->assertStatus(404);
    }
}
