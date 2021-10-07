<?php

namespace App\Http\Controllers;

use App\Http\Resources\Subscribe\SubscribeCollection;
use App\Http\Resources\Subscribe\SubscribeResource;
use App\Models\Subscribable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subscribable::class);
    }

    public function index(): SubscribeCollection
    {
        return new SubscribeCollection(auth()->user()->subscribes()->paginate(20));
    }

    // subscribe
    public function store(Request $request): SubscribeResource
    {
        $subscribable = new Subscribable();
        $subscribable->user_id = auth()->user()->id;
        $subscribable->subscribable_id = $request->get("subscribable_id");
        $subscribable->subscribable_type = $request->get("subscribable_type");
        $subscribable->save();
        return new SubscribeResource($subscribable);
    }

    // unsubscribe
    public function destroy(Subscribable $subscribable): Response
    {
        return response("", Status::HTTP_NO_CONTENT);
    }
}
