<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Models\Image;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __invoke(int $id)
    {
        return Image::find($id)->users;
    }

}
