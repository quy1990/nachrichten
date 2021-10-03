<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index(): RoleCollection
    {
        return new RoleCollection(Role::paginate(20));
    }

    public function store(Request $request): RoleResource
    {
        $role = new Role();
        $role->name = $request->get("name");
        $role->save();
        return new RoleResource($role);
    }

    public function show(role $role): RoleResource
    {
        return new RoleResource($role);
    }

    public function update(Request $request, role $role): RoleResource
    {
        $role->name = $request->get("name");
        $role->save();
        return new RoleResource($role);
    }
}
