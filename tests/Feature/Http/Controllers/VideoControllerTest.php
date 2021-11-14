<?php

namespace Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Category\Entities\Category;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/videos/";

    private $model;
    /**
     * @var string[]
     */
    private array $header;
    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->model = Video::factory()->create([
            'user_id' => $this->user->id,
            'category_id' => $this->category->id]);

        $token = auth()->fromUser($this->user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $response = $this->post($this->url, [
            'video_path' => 'video_path',
            'title' => 'abc',
            'body' => 'body abc',
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $response = $this->put($this->url . $this->model->id, [
            'video_path' => 'video_path',
            'title' => 'abc',
            'body' => 'body abc',
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->header);
        $response->assertStatus(204);
    }

    public function test_index()
    {
        $response = $this->get($this->url, $this->header);
        $response->assertStatus(200);
    }
}
