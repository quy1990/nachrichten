<?php

namespace Http\Controllers\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $url = "/api/users/";

    private $model;
    private array $header;
    private Collection|Model $normalUser;
    /**
     * @var string[]
     */
    private array $normalUserHeader;

    public function setUp(): void
    {
        parent::setUp();
        $users = User::factory(5)->create();
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'Administrator']);
        $user->roles()->attach($role);
        $this->model = User::factory()->create();
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

    public function test_index()
    {
        $response = $this->get($this->url, $this->header);
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get($this->url . $this->model->id, $this->header);
        $response->assertStatus(200);
    }
}
