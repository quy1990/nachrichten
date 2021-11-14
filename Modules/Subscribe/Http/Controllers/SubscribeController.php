<?php

namespace Modules\Subscribe\Http\Controllers;

use Modules\Subscribe\Entities\Subscribable;
use Modules\Subscribe\Http\Requests\SubscribeRequest;
use Modules\Subscribe\Resources\SubscribeResource;
use App\Http\Controllers\Controller;

;

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
