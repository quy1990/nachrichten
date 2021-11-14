<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use Modules\Image\Entities\User;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(User::class, 'User');
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        return new UserCollection(User::paginate(20));
    }

    /**
     * Display the specified resource.
     *
     * @param User $User
     * @return UserResource
     */
    public function show(User $User): UserResource
    {
        return new UserResource($User);
    }
}
