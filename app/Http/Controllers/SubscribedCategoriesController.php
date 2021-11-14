<?php

namespace App\Http\Controllers;

use Modules\Category\Resources\CategoryCollection;


class SubscribedCategoriesController extends Controller
{
    public function __invoke(): CategoryCollection
    {
        $user = auth()->user();
        return new CategoryCollection($user->subscribedCategories);
    }
}
