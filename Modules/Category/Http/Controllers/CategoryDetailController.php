<?php

namespace Modules\Category\Http\Controllers;

use Modules\Category\Entities\Category;
use Modules\Category\Resources\CategoryDetailCollection;
use Modules\User\Http\Controllers\Controller;

class CategoryDetailController extends Controller
{
    public function __invoke(): CategoryDetailCollection
    {
        return new CategoryDetailCollection(Category::withCount('posts')->get());
    }
}
