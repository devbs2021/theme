<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\Models\Site;
use DevbShrestha\Theme\Requests\UpdateSiteRequest;
use DevbShrestha\Theme\Traits\FileUpload;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('company_profile'), 403);

        return view('theme::site.index');
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
    public function store(UpdateSiteRequest $request)
    {
        abort_if(!auth()->user()->can('company_profile'), 403);

        try {
            $data = $request->validated();

            if ($request->logo) {
                $data['logo'] = $this->uploadFile('site', $request->logo);
            }
            if ($request->favicon) {
                $data['favicon'] = $this->uploadFile('site', $request->favicon);
            }
            $site = Site::first();
            $site->update($data);

            return redirect()->back()->with('success', 'Successfully Created');
        } catch (\Exception$ex) {

            return redirect()->back()->with('error', 'Something went wrong!!');

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
