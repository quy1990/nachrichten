<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Requests\RoleStoreRequest;
use Modules\Role\Http\Requests\RoleUpdateRequest;
use Modules\Role\Resources\RoleCollection;
use Modules\Role\Resources\RoleResource;
use Modules\Status\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Role::class, 'role');
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
