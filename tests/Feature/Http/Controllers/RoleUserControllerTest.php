<?php

namespace Http\Controllers;

use App\Http\Controllers\RoleUserController;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class RoleUserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = Role::factory()->create();
        $this->user = User::factory()->create();
        $this->role->users()->attach($this->user->id);
    }

    public function test__invoke()
    {
        $response = $this->get('/api/roles/' . $this->role->id . '/users');
        $response->assertStatus(200);
    }
}
