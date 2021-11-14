<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Resources\CommentCollection;
use Modules\User\Entities\User;

class CommentUserController extends Controller
{
    public function __invoke(int $id): CommentCollection
    {
        return new CommentCollection(User::find($id)->comments);
    }
}
