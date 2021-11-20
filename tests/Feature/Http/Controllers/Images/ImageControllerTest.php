<?php

namespace Http\Controllers\Images;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/images/";

    private $model;
    private array $arr;
    private $post;
    private array $header;
    private Collection|Model $normalUser;
    private array $normalUserHeader;

    public function setUp(): void
    {
        parent::setUp();
        $this->arr = ['App\Models\Post', 'App\Models\User'];
        $role = Role::factory()->create(['name' => 'Administrator']);
        $user = User::factory()->create();
        $user->roles()->attach($role);

        $category = Category::factory()->create();
        $this->post = Post::factory()->create(['category_id' => $category->id]);
        $this->model = Image::factory()->create([
            'imageable_id'   => 1,
            'imageable_type' => $this->arr[rand(0, 1)]
        ]);

        $token = auth()->fromUser($user);
        $this->header = [
            'Authorization' => 'bearer ' . $token
        ];


        $role = Role::factory()->create(['name' => 'User']);
        $this->normalUser = User::factory()->create();
        $this->normalUser->roles()->attach($role);
        $normalUserToken = auth()->fromUser($this->normalUser);
        $this->normalUserHeader = [
            'Authorization' => 'bearer ' . $normalUserToken
        ];
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
        $response->assertStatus(200);
    }

    public function test_store_for_admin()
    {
        $response = $this->post($this->url, [
            'url'            => 'https://via.placeholder.com/640x480.png/00aa99',
            'user_id'        => 1,
            'imageable_id'   => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
        ], $this->header);

        $response->assertStatus(201);
    }

    public function test_update_for_admin()
    {
        $response = $this->put($this->url . $this->model->id, [
            'url'            => 'https://via.placeholder.com/640x480.png/00aa99',
            'user_id'        => 1,
            'imageable_id'   => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
        ], $this->header);

        $response->assertStatus(200);
    }

    public function test_destroy_for_admin()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->header);
        $response->assertStatus(204);
    }

    public function test_store_for_normal_user()
    {
        $response = $this->post($this->url, [
            'url'            => 'https://via.placeholder.com/640x480.png/00aa99',
            'user_id'        => 1,
            'imageable_id'   => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
        ], $this->normalUserHeader);

        $response->assertStatus(201);
    }

    public function test_update_for_normal_user()
    {
        $response = $this->put($this->url . $this->model->id, [
            'url'            => 'https://via.placeholder.com/640x480.png/00aa99',
            'user_id'        => 1,
            'imageable_id'   => 1,
            'imageable_type' => $this->arr[rand(0, 1)],
        ], $this->normalUserHeader);

        $response->assertStatus(403);
    }

    public function test_destroy_for_normal_user()
    {
        $response = $this->delete($this->url . $this->model->id, [], $this->normalUserHeader);
        $response->assertStatus(403);
    }

    public function test_index()
    {
        $response = $this->get($this->url, $this->header);
        $response->assertStatus(200);
    }
}
