<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use Modules\Role\Entities\Role;

class UserRoleController extends Controller
{
    public function __invoke(Role $role): UserCollection
    {
        return new UserCollection($role->users);
    }
}
