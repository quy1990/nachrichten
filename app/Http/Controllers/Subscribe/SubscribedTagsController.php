<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagCollection;


class SubscribedTagsController extends Controller
{
    public function __invoke(): TagCollection
    {
        $user = auth()->user();
        return new TagCollection($user->subscribedTags);
    }
}
