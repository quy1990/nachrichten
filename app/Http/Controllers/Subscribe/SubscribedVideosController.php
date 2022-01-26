<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Resources\Video\VideoCollection;


class SubscribedVideosController extends Controller
{
    public function __invoke(): VideoCollection
    {
        $user = auth()->user();
        return new VideoCollection($user->subscribedVideos);
    }
}
