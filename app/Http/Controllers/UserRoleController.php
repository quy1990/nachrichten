<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use Modules\Category\Entities\Role;

class UserRoleController extends Controller
{
    public function __invoke(Role $role): UserCollection
    {
        return new UserCollection($role->users);
    }
}
