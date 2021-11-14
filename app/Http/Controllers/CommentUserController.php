<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentCollection;
use Modules\Category\Entities\User;

class CommentUserController extends Controller
{
    public function __invoke(int $id): CommentCollection
    {
        return new CommentCollection(User::find($id)->comments);
    }
}
