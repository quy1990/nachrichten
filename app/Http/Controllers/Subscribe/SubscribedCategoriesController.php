<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;


class SubscribedCategoriesController extends Controller
{
    public function __invoke(): CategoryCollection
    {
        $user = auth()->user();
        return new CategoryCollection($user->subscribedCategories);
    }
}
