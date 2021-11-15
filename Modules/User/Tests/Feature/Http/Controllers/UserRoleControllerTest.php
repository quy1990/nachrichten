<?php

namespace Modules\User\Tests\Feature\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Role\Entities\Role;
use Modules\User\Entities\User;
use Tests\TestCase;


class UserRoleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $tag;
    /**
     * @var Collection|Model
     */
    private $video;
    /**
     * @var Collection|Model
     */
    private $post;
    /**
     * @var Collection|Model
     */
    private $taggable;
    /**
     * @var Collection|Model
     */
    private $category;
    /**
     * @var Collection|Model
     */
    private $role;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = Role::factory()->create();
        $user = User::factory()->create();
        $user->roles()->attach($this->role->id);
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->role->users);
        $response = $this->get('/api/roles/' . $this->role->id . '/users');
        $response->assertStatus(200);
    }
}
