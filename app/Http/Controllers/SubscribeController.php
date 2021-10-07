<?php

namespace App\Http\Controllers;

use App\Http\Resources\Subscribe\SubscribeCollection;
use App\Http\Resources\Subscribe\SubscribeResource;
use App\Models\Subscribable;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subscribe::class);
    }

    public function index(): SubscribeCollection
    {
        return new SubscribeCollection(auth()->user()->subscribes()->paginate(20));
    }

    // subscribe
    public function store(Request $request): SubscribeResource
    {
        $subscribe = new Subscribe();
        $subscribe->user_id = auth()->user()->id;
        $subscribe->subscribable_id = $request->get("subscribable_id");
        $subscribe->subscribable_type = $request->get("subscribable_type");
        $subscribe->save();;
        return new SubscribeResource($subscribe);
    }

    // unsubscribe
    public function destroy(Subscribe $subscribe): Response
    {
        return response("", Status::HTTP_NO_CONTENT);
    }
}
