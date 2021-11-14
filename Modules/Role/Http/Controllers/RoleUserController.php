<?php

namespace Modules\Role\Http\Controllers;

use Modules\Role\Entities\Role;
use Modules\Role\Resources\RoleCollection;
use App\Http\Controllers\Controller;;

class RoleUserController extends Controller
{
    public function __invoke(int $id): RoleCollection
    {
        return new RoleCollection(Role::find($id)->users);
    }
}
