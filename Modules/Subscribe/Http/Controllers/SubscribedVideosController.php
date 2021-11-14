<?php

namespace Modules\Subscribe\Http\Controllers;

use Modules\User\Http\Controllers\Controller;
use Modules\Video\Resources\VideoCollection;


class SubscribedVideosController extends Controller
{
    public function __invoke(): VideoCollection
    {
        $user = auth()->user();
        return new VideoCollection($user->subscribedVideos);
    }
}
