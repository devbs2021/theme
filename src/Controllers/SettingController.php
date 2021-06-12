<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\Models\Setting;
use Illuminate\Http\Request;
use Theme;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('site_setting'), 403);

        return view('theme::setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('site_setting'), 403);

        foreach (Theme::setting() as $setting) {
            $moduleName = $setting->module;
            $check = Setting::where('module', $moduleName)->first();
            if ($request->$moduleName) {

                $check->update([
                    'status' => 1,
                ]);

            } else {
                if ($moduleName == 'Theme') {
                    return redirect()->back()->with('error', 'You cannot disable theme package');
                }
                $check->update([
                    'status' => 0,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Successfully Updated!!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
