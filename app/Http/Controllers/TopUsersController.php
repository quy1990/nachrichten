<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use Modules\Category\Entities\User;


class TopUsersController extends Controller
{
    public function __invoke(): UserCollection
    {
        return new UserCollection(User::paginate(5));
    }
}
