<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                "name"  => "Dashboard",
                "route" => "/nachricht-react-admin/",
                "icon"  => "bx bx-category-alt"
            ],
            [
                "name"  => "Tags",
                "route" => "/nachricht-react-admin/tags",
                "icon"  => "bx bx-tag"
            ],
            [
                "name"  => "Posts",
                "route" => "/nachricht-react-admin/posts",
                "icon"  => "bx bxs-detail"
            ],
            [
                "name"  => "Users",
                "route" => "/nachricht-react-admin/users",
                "icon"  => "bx bx-user"
            ],
            [
                "name"  => "categories",
                "route" => "/nachricht-react-admin/categories",
                "icon"  => "bx bx-list-ol"
            ],
            [
                "name"  => "Roles",
                "route" => "/nachricht-react-admin/roles",
                "icon"  => "bx bx-male"
            ],
            [
                "name"  => "Comments",
                "route" => "/nachricht-react-admin/comments",
                "icon"  => "bx bx-comment"
            ],
            [
                "name"  => "Statuses",
                "route" => "/nachricht-react-admin/statuses",
                "icon"  => "bx bx-bell"
            ],
            [
                "name"  => "profile",
                "route" => "/nachricht-react-admin/profile",
                "icon"  => "bx bx-comment"
            ]
        ];
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
