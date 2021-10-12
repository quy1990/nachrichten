<?php

namespace App\Http\Controllers;

use App\Http\Resources\Video\VideoCollection;


class SubscribedVideosController extends Controller
{
    public function __invoke(): VideoCollection
    {
        $user = auth()->user();
        return new VideoCollection($user->subscribedVideos);
    }
}
