<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Models\User;


class TopUsersController extends Controller
{
    public function __invoke(): UserCollection
    {
        return new UserCollection(User::paginate(5));
    }
}
