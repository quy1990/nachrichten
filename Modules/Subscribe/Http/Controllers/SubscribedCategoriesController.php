<?php

namespace Modules\Subscribe\Http\Controllers;

use Modules\Category\Resources\CategoryCollection;
use App\Http\Controllers\Controller;


class SubscribedCategoriesController extends Controller
{
    public function __invoke(): CategoryCollection
    {
        $user = auth()->user();
        return new CategoryCollection($user->subscribedCategories);
    }
}
