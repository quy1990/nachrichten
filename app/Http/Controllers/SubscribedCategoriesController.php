<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;


class SubscribedCategoriesController extends Controller
{
    public function __invoke(): CategoryCollection
    {
        if (!auth()->user()) {
            return new CategoryCollection(new Category());
        }

        $user = auth()->user();
        return new CategoryCollection($user->subscribedCategories);
    }
}
