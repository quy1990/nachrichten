<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryDetailCollection;
use App\Models\Category;

class CategoryDetailController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function __invoke(): CategoryDetailCollection
    {
        return new CategoryDetailCollection(Category::withCount('posts')->get());
    }
}
