<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\Post;
use Modules\Category\Entities\Tag;
use Modules\Category\Entities\User;

class DashBroadController extends Controller
{
    public function __invoke(): JsonResponse
    {
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
