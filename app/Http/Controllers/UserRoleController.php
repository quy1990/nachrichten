<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleCollection;
use App\Models\Role;

class UserRoleController extends Controller
{
    public function __invoke(int $id): RoleCollection
    {
        return new RoleCollection(Role::find($id)->users);
    }
}
