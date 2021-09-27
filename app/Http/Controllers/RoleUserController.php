<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function __invoke(int $id)
    {
        return Role::find($id)->users;
    }

}
