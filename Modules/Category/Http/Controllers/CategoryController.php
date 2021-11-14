<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
use Modules\Category\Entities\Category;
use Modules\Category\Resources\CategoryCollection;
use Modules\Category\Resources\CategoryResource;
use Modules\Image\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Category::class, 'category');
    }

    public function index(): CategoryCollection
    {
        return new CategoryCollection(Category::paginate(20));
    }

    public function store(Request $request): CategoryResource
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->save();
        return new CategoryResource($category);
    }

    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category): CategoryResource
    {
        $category->name = $request->get('name');
        $category->save();
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
