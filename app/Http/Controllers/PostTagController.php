<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Tag\TagCollection;
use App\Models\Post;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function __invoke(int $id): TagCollection
    {
        return new TagCollection(Post::find($id)->tags);
    }
}
