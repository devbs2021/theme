<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\DataTables\MenuDataTable;
use DevbShrestha\Theme\Models\Menu;
use DevbShrestha\Theme\Requests\StoreMenuRequest;
use DevbShrestha\Theme\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('menu_view'), 403);

        return $dataTable->render('theme::menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('menu_create'), 403);

        return view('theme::menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        abort_if(!auth()->user()->can('menu_create'), 403);

        try {

            $data = $request->validated();

            Menu::create($data);

            return redirect()->route('menus.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('menus.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        abort_if(!auth()->user()->can('menu_edit'), 403);

        return view('theme::menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        abort_if(!auth()->user()->can('menu_update'), 403);

        try {
            $data = $request->validated();

            $menu->update($data);

            return redirect()->route('menus.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('menus.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        abort_if(!auth()->user()->can('menu_delete'), 403);

        try {

            $menu->delete();

            return redirect()->route('menus.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('menus.index')->with('error', 'Something went wrong!!');

        }
    }
}
