<?php

namespace Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $user;
    /**
     * @var Collection|Model
     */
    private $images;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->images = Image::factory(5)->create(['imageable_type' => 'App\Models\User']);
    }

    public function test__invoke()
    {
        $response = $this->get('/api/users/' . $this->user->id . '/image');
        $response->assertStatus(200);
    }
}
