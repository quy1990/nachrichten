<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\User\Http\Controllers\Controller;

class UserSubscribesController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = auth()->user();
        $subscribedContents = [
            'posts'           => $user->subscribedPosts,
            'videos'          => $user->subscribedVideos,
            'categories'      => $user->subscribedCategories,
            'subscribedUsers' => $user->subscribedUsers,
        ];

        return response()->json($subscribedContents);
    }
}
