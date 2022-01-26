<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscribs\UnsubscribeRequest;
use App\Models\Subscribable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class UnsubscribeController extends Controller
{
    public function __invoke(UnsubscribeRequest $request): Response|Application|ResponseFactory
    {
        Subscribable::where('subscribable_id', $request->get("subscribable_id"))
            ->where('subscribable_type', $request->get("subscribable_type"))
            ->where('user_id', $request->get("user_id"))
            ->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
