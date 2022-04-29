<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class CategoryController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Category::class, 'category');
//    intlcal_is_equivalent_to();

    }

    public function index(): CategoryCollection
    {
        return new CategoryCollection(Category::paginate(20));
//        CategoryCollection::class
    }

    public function store(CategoryStoreRequest $request): CategoryResource
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

    public function update(CategoryUpdateRequest $request, Category $category): CategoryResource
    {
        $category->name = $request->get('name');
        $category->save();
        return new CategoryResource($category);
    }

    public function destroy(Category $category): Response|Application|ResponseFactory
    {
        $category->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
