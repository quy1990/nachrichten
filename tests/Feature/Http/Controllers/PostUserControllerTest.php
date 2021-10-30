<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $role;
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
    private $user;
    /**
     * @var string[]
     */
    private array $header;

    public function setUp(): void
    {
        parent::setUp();
        $category = Category::factory()->create();
        $this->user = User::factory()->create();
        $this->post = Post::factory(5)->create([
            'category_id' => $category->id,
            'created_by'  => $this->user->id]);
        $token = auth()->fromUser($this->user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->posts);
        $response = $this->get('/api/users/' . $this->user->id . '/posts', $this->header);
        $response->assertStatus(200);
    }
}
