<?php

namespace Modules\Subscribe\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use App\Http\Controllers\Controller;

class SubscribedTagsController extends Controller
{
    public function __invoke(): TagCollection
    {
        $user = auth()->user();
        return new TagCollection($user->subscribedTags);
    }
}
