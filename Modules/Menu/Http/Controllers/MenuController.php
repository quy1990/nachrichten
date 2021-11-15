<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Resources\MenuCollection;
use Modules\Menu\Resources\MenuResource;

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
        $menu = new Menu();
        $menu->name = $request->get('name');
        $menu->route = $request->get('route');
        $menu->icon = $request->get('icon');
        $menu->save();
        return new MenuResource($menu);
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
