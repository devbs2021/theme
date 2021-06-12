<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\DataTables\RoleDataTable;
use DevbShrestha\Theme\Requests\StoreRoleRequest;
use DevbShrestha\Theme\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(RoleDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('role_view'), 403);

        return $dataTable->render('theme::role.index');

    }
    public function create()
    {
        abort_if(!auth()->user()->can('role_create'), 403);

        return view('theme::role.create');
    }
    public function store(StoreRoleRequest $request)
    {
        abort_if(!auth()->user()->can('role_create'), 403);

        try {

            $role = Role::create([
                'name' => $request->name,
            ]);
            $role->syncPermissions($request->permissions);

            return redirect()->route('roles.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('roles.index')->with('error', 'Somethning went wrong!!');
        }

    }

    public function edit(Role $role)
    {
        abort_if(!auth()->user()->can('role_edit'), 403);

        return view('theme::role.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if(!auth()->user()->can('role_update'), 403);

        try {

            $data = $request->validated();
            $role->update($data);
            $role->syncPermissions($request->permissions);

            return redirect()->route('roles.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('roles.index')->with('error', 'Something Went Wrong!!');

        }

    }

    public function destroy(Role $role)
    {
        abort_if(!auth()->user()->can('role_delete'), 403);

        try {

            $role->syncPermissions([]);
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('roles.index')->with('error', 'Something went wrong!!');

        }
    }
}
