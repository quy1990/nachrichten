<?php

namespace App\Http\Controllers;

use App\Http\Resources\Menu\MenuCollection;
use App\Http\Resources\Menu\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class MenuController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Menu::class, 'Menu');
    }

    public function index(): MenuCollection
    {
        return new MenuCollection(Menu::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return MenuResource
     */
    public function store(Request $request): MenuResource
    {
        return new MenuResource([]);
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return MenuResource
     */
    public function show(Menu $menu): MenuResource
    {
        return new MenuResource($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Menu $menu
     * @return MenuResource
     */
    public function update(Request $request, Menu $menu): MenuResource
    {
        $menu->update($request->all());
        return new MenuResource($menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return Response
     */
    public function destroy(Menu $menu): Response
    {
        $menu->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}