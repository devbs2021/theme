<?php

namespace Devbs\Theme\Controllers;

use Devbs\Theme\Requests\StoreUserRequest;
use Devbs\Theme\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Models\User;
use Devbs\Theme\DataTables\UsersDataTable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        abort_if(!in_array('user_view',json_decode(auth()->user()->permissions->permissions)),403);
        return $dataTable->render('theme::user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!in_array('user_create',json_decode(auth()->user()->permissions->permissions)),403);
        return view('theme::user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        abort_if(!in_array('user_create', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $data = $request->except('password');
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $user = User::create($data);
            if ($request->permissions) {
                $user->permissions()->create([
                    'permissions' => json_encode($request->permissions),
                ]);
            }

            return redirect()->route('users.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('users.index')->with('error', 'Something went wrong!!');

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
    public function edit(User $user)
    {
        abort_if(!in_array('user_edit', json_decode(auth()->user()->permissions->permissions)), 403);

        return view('theme::user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(!in_array('user_update', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $data = $request->except('password');
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $user->update($data);
            if ($request->permissions) {
                $user->permissions()->withTrashed()->update([
                    'permissions' => json_encode($request->permissions),
                    'deleted_at'=>null
                ]);
            }

            return redirect()->route('users.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('users.index')->with('error', 'Something went wrong!!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(!in_array('user_delete', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $user->permissions()->delete();
            // $user->delete();

            return redirect()->route('users.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('users.index')->with('error', 'Something went wrong!!');

        }

    }
}
