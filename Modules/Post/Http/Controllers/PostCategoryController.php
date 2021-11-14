<?php

namespace Modules\Post\Http\Controllers;

use Modules\Category\Entities\Category;
use Modules\Post\Resources\PostCollection;
use App\Http\Controllers\Controller;;

class PostCategoryController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(Category::find($id)->posts);
    }
}
