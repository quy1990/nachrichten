<?php

namespace Modules\Subscribe\Http\Controllers;

use Illuminate\Http\Request;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
use Modules\Subscribe\Entities\Subscribable;
use App\Http\Controllers\Controller;

;

class UnsubscribeController extends Controller
{
    public function __invoke(Request $request)
    {
        Subscribable::where('subscribable_id', $request->get("subscribable_id"))
            ->where('subscribable_type', $request->get("subscribable_type"))
            ->where('user_id', $request->get("user_id"))
            ->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
