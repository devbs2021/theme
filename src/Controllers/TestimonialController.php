<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\DataTables\TestimonialDataTable;
use DevbShrestha\Theme\Models\Testimonial;
use DevbShrestha\Theme\Requests\StoreTestimonialRequest;
use DevbShrestha\Theme\Requests\UpdateTestimonialRequest;
use DevbShrestha\Theme\Traits\FileUpload;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TestimonialDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('testimonial_view'), 403);

        return $dataTable->render('theme::testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('testimonial_create'), 403);

        return view('theme::testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestimonialRequest $request)
    {
        abort_if(!auth()->user()->can('testimonial_create'), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('testimonial', $request->image);
            }
            (!$request->position) ? $data['position'] = 1 : $data['position'] = $request->position;
            Testimonial::create($data);

            return redirect()->route('testimonials.index')->with('success', 'Successfully Created!!');

        } catch (\Exception$ex) {

            return redirect()->route('testimonials.index')->with('error', 'Something went wrong!!');

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
    public function edit(Testimonial $testimonial)
    {
        abort_if(!auth()->user()->can('testimonial_edit'), 403);

        return view('theme::testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UPdateTestimonialRequest $request, Testimonial $testimonial)
    {
        abort_if(!auth()->user()->can('testimonial_update'), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('testimonial', $request->image);
            }
            $data['status'] = $request->status ? 1 : 0;

            $testimonial->update($data);

            return redirect()->route('testimonials.index')->with('success', 'Successfully updated!!');

        } catch (\Exception$ex) {

            return redirect()->route('testimonials.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        abort_if(!auth()->user()->can('testimonial_delete'), 403);

        try {

            $testimonial->delete();

            return redirect()->route('testimonials.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception$ex) {

            return redirect()->route('testimonials.index')->with('error', 'Something went wrong!!');

        }
    }
}
