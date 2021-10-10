<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Subscribable;

class SubscribeController extends Controller
{
    public function __invoke(SubscribeRequest $request): string
    {
        return Subscribable::firstOrCreate([
            'user_id' => auth()->user()->id,
            'subscribable_id' => $request->get("subscribable_id"),
            'subscribable_type' => $request->get("subscribable_type"),
        ]);
    }
}
