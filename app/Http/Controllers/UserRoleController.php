<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use App\Models\Role;

class UserRoleController extends Controller
{
    public function __invoke(int $id): UserCollection
    {
        return new UserCollection(Role::find($id)->users);
    }
}
