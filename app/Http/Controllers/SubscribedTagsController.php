<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;


class SubscribedTagsController extends Controller
{
    public function __invoke(): TagCollection
    {
        $user = auth()->user();
        return new TagCollection($user->subscribedTags);
    }
}
