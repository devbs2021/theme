<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\DataTables\CMSDataTable;
use DevbShrestha\Theme\Models\CMS;
use DevbShrestha\Theme\Requests\StoreCMSRequest;
use DevbShrestha\Theme\Requests\UpdateCMSRequest;
use DevbShrestha\Theme\Traits\FileUpload;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CMSDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('page_view'), 403);

        return $dataTable->render('theme::cms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('page_create'), 403);

        return view('theme::cms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCMSRequest $request)
    {
        abort_if(!auth()->user()->can('page_create'), 403);

        try {
            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('cms', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }

            $data['seo'] = $seo;

            $cms = CMS::create($data);

            if ($request->slug) {
                $cms->slug = $request->slug;
                $cms->save();
            }

            return redirect()->route('cms.index')->with('success', 'Successfully Created!!');

        } catch (\Exception$ex) {

            return redirect()->route('cms.index')->with('error', 'Something went wrong!!');

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
    public function edit(CMS $cm)
    {
        abort_if(!auth()->user()->can('page_edit'), 403);

        $cms = $cm;
        return view('theme::cms.edit', compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCMSRequest $request, CMS $cm)
    {
        abort_if(!auth()->user()->can('page_update'), 403);

        $cms = $cm;
        try {
            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('cms', $request->image);
            }
            $seo = [];
            if ($request->meta_title) {
                $seo['meta_title'] = $request->meta_title;
            }
            if ($request->meta_description) {
                $seo['meta_description'] = $request->meta_description;
            }

            $data['seo'] = $seo;
            $data['status'] = $request->status ? 1 : 0;

            $cms->update($data);
            if ($request->slug) {
                $cms->slug = $request->slug;
                $cms->save();
            }

            return redirect()->route('cms.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception$ex) {

            return redirect()->route('cms.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CMS $cm)
    {
        abort_if(!auth()->user()->can('page_delete'), 403);

        try {

            $cm->delete();

            return redirect()->route('cms.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception$ex) {

            return redirect()->route('cms.index')->with('error', 'Something went wrong!!');

        }
    }
}
