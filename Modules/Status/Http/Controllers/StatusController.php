<?php

namespace Modules\Status\Http\Controllers;

use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes;
use Modules\Post\Http\Requests\Statuses\StatusStoreRequest;
use Modules\Post\Http\Requests\Statuses\StatusUpdateRequest;
use Modules\Status\Entities\Status;
use Modules\Status\Resources\StatusCollection;
use Modules\Status\Resources\StatusResource;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Status::class, 'Status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return StatusCollection
     */
    public function index(): StatusCollection
    {
        return new StatusCollection(Status::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatusStoreRequest $request
     * @return StatusResource
     */
    public function store(StatusStoreRequest $request): StatusResource
    {
        $status = new Status();
        $status->name = $request->get('name');
        $status->save();
        return new StatusResource($status);
    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return StatusResource
     */
    public function show(Status $status): StatusResource
    {
        return new StatusResource($status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusUpdateRequest $request
     * @param Status $status
     * @return StatusResource
     */
    public function update(StatusUpdateRequest $request, Status $status): StatusResource
    {
        $status->update($request->all());
        return new StatusResource($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return Response
     */
    public function destroy(Status $status): Response
    {
        $status->delete();
        return response("", Httpstatuscodes::HTTP_NO_CONTENT);
    }
}
