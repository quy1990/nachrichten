<?php

namespace App\Providers;

use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use App\Policies\SubscribablePolicy;
use App\Policies\TagPolicy;
use App\Policies\VideoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\Comment;
use Modules\Category\Entities\Post;
use Modules\Category\Entities\Role;
use Modules\Category\Entities\Tag;
use Modules\Category\Entities\Video;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Tag::class => TagPolicy::class,
        Post::class => PostPolicy::class,
        Role::class => RolePolicy::class,
        Video::class => VideoPolicy::class,
        Comment::class => CommentPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
