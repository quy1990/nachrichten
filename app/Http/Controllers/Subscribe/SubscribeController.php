<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscribs\SubscribeRequest;
use App\Http\Resources\Subscribe\SubscribeResource;
use App\Models\Subscribable;

class SubscribeController extends Controller
{
    public function __invoke(SubscribeRequest $request): SubscribeResource
    {
        return new SubscribeResource(Subscribable::firstOrCreate([
            'user_id'           => auth()->user()->id,
            'subscribable_id'   => $request->get("subscribable_id"),
            'subscribable_type' => $request->get("subscribable_type"),
        ]));
    }
}
