<?php

namespace App\Http\Controllers\Dashbroad;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DashBroadController extends Controller
{
    public function __invoke(): JsonResponse
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $data = [
            $this->getDashBroadPost(),
            $this->getDashBroadCategory(),
            $this->getDashBroadTag(),
            $this->getDashBroadUser(),
        ];
        return response()->json(['data' => $data]);
    }

    private function getDashBroadPost(): array
    {
        return [
            "icon"  => "bx bxs-detail",
            "count" => Post::count(),
            "title" => "Total Posts",
            "url"   => "/posts"
        ];
    }

    private function getDashBroadCategory(): array
    {
        return [
            "icon"  => "bx bx-list-ol",
            "count" => Category::count(),
            "title" => "Total Categories",
            "url"   => "/categories"
        ];
    }

    private function getDashBroadTag(): array
    {
        return [
            "icon"  => "bx bx-tag",
            "count" => Tag::count(),
            "title" => "Total Tags",
            "url"   => "/tags"
        ];
    }

    private function getDashBroadUser(): array
    {
        return [
            "icon"  => "bx bx-user",
            "count" => User::count(),
            "title" => "Total Users",
            "url"   => "/users"
        ];
    }
}
