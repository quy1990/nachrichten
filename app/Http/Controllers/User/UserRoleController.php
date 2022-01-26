<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Models\Role;

class UserRoleController extends Controller
{
    public function __invoke(Role $role): UserCollection
    {
        return new UserCollection($role->users);
    }
}
