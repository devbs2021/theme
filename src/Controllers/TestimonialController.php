<?php

namespace Devbs\Theme\Controllers;

use App\Http\Controllers\Controller;
use Devbs\Theme\Models\Testimonial;
use Devbs\Theme\Requests\StoreTestimonialRequest;
use Devbs\Theme\Requests\UpdateTestimonialRequest;
use Illuminate\Http\Request;
use Devbs\Theme\Traits\FileUpload;
use Devbs\Theme\DataTables\TestimonialDataTable;

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
        abort_if(!in_array('testimonial', json_decode(auth()->user()->permissions->permissions)), 403);

        return $dataTable->render('theme::testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!in_array('testimonial', json_decode(auth()->user()->permissions->permissions)), 403);

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
        abort_if(!in_array('testimonial', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('testimonial', $request->image);
            }
            (!$request->position)?$data['position']=1:$data['position']=$request->position;
            Testimonial::create($data);

            return redirect()->route('testimonials.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

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
        abort_if(!in_array('testimonial', json_decode(auth()->user()->permissions->permissions)), 403);

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
        abort_if(!in_array('testimonial', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $data = $request->validated();
            if ($request->image) {
                $data['image'] = $this->uploadFile('testimonial', $request->image);
            }
            $testimonial->update($data);

            return redirect()->route('testimonials.index')->with('success', 'Successfully updated!!');

        } catch (\Exception $ex) {

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
        abort_if(!in_array('testimonial', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $testimonial->delete();

            return redirect()->route('testimonials.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('testimonials.index')->with('error', 'Something went wrong!!');

        }
    }
}