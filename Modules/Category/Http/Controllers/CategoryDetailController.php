<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Resources\CategoryDetailCollection;

class CategoryDetailController extends Controller
{
    public function __invoke(): CategoryDetailCollection
    {
        return new CategoryDetailCollection(Category::withCount('posts')->get());
    }
}
