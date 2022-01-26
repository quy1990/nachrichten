<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryDetailCollection;
use App\Models\Category;

class CategoryDetailController extends Controller
{
    public function __invoke(): CategoryDetailCollection
    {
        return new CategoryDetailCollection(Category::withCount('posts')->paginate());
    }
}
