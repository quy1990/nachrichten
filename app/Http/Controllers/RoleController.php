<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

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

    public function store(RoleStoreRequest $request): RoleResource
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

    public function update(RoleUpdateRequest $request, role $role): RoleResource
    {
        $role->name = $request->get("name");
        $role->save();
        return new RoleResource($role);
    }

    public function destroy(Role $role): Response
    {
        $role->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
