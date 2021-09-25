<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Post\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(Category::find($id)->posts);
    }
}
