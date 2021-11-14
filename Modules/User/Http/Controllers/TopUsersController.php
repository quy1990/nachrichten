<?php
namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use Modules\User\Entities\User;

class TopUsersController extends Controller
{
    public function __invoke(): UserCollection
    {
        return new UserCollection(User::paginate(5));
    }
}
