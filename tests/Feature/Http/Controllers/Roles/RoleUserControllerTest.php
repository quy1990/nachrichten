<?php

namespace Http\Controllers\Roles;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleUserControllerTest extends TestCase
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

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->role = Role::factory()->create();
    }

    public function test__invoke()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->role->users);
        $response = $this->get('/api/users/' . $this->role->id . '/roles');
        $response->assertStatus(200);
    }
}
