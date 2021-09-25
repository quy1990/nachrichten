<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return new RoleCollection(Role::paginate(20));
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->get("name");
    }

    public function show(role $role)
    {
        return new RoleResource($role);
    }

    public function update(Request $request, role $role)
    {
        $role->name = $request->get("name");
        $role->save();
        return new RoleResource($role);
    }
}
