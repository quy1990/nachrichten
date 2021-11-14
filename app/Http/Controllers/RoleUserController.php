<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleCollection;
use Modules\Category\Entities\Role;

class RoleUserController extends Controller
{
    public function __invoke(int $id): RoleCollection
    {
        return new RoleCollection(Role::find($id)->users);
    }
}
