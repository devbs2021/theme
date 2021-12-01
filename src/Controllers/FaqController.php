<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\DataTables\FaqDataTable;
use DevbShrestha\Theme\Models\Faq;
use DevbShrestha\Theme\Requests\StoreFaqRequest;
use DevbShrestha\Theme\Requests\UpdateFaqRequest;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FaqDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('faq_view'), 403);

        return $dataTable->render('theme::faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('faq_create'), 403);

        return view('theme::faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqRequest $request)
    {
        abort_if(!auth()->user()->can('faq_create'), 403);

        try {

            $data = $request->validated();
            Faq::create($data);

            return redirect()->route('faqs.index')->with('success', 'Successfully Created');

        } catch (\Exception$ex) {

            return redirect()->route('faqs.index')->with('error', 'Something went wrong');

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
    public function edit(Faq $faq)
    {
        abort_if(!auth()->user()->can('faq_edit'), 403);

        return view('theme::faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        abort_if(!auth()->user()->can('faq_update'), 403);

        try {

            $data = $request->validated();
            $data['status'] = $request->status ? 1 : 0;

            $faq->update($data);

            return redirect()->route('faqs.index')->with('success', 'Successfully Updated');

        } catch (\Exception$ex) {

            return redirect()->route('faqs.index')->with('error', 'Something went wrong');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        abort_if(!auth()->user()->can('faq_delete'), 403);

        try {
            $faq->delete();

            return redirect()->route('faqs.index')->with('success', 'Successfully Deleted');

        } catch (\Exception$ex) {

            return redirect()->route('faqs.index')->with('error', 'Something went wrong');

        }
    }
}
