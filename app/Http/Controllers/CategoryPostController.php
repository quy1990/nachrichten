<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;
use App\Models\Category;

class CategoryPostController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(Category::find($id)->posts);
    }
}
