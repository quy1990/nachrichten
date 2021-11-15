<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleCollection;
use App\Models\Role;

class RoleUserController extends Controller
{
    public function __invoke(int $id): RoleCollection
    {
        return new RoleCollection(Role::find($id)->users);
    }
}
