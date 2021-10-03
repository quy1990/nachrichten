<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentCollection;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class CommentUserController extends Controller
{
    public function __invoke(): CommentCollection
    {
        return new CommentCollection(User::find(1)->comments);
    }
}
