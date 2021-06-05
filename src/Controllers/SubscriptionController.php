<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\DataTables\SubscriptionDataTable;
use DevbShrestha\Theme\Models\Subscription;
use DevbShrestha\Theme\Requests\StoreSubscriptionRequest;
use DevbShrestha\Theme\Requests\UpdateSubscriptionRequest;
use Illuminate\Http\Request;
use Theme;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscriptionDataTable $dataTable)
    {
        abort_if(!in_array('subscription', json_decode(auth()->user()->permissions->permissions)), 403);

        return $dataTable->render('theme::subscription.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!in_array('subscription', json_decode(auth()->user()->permissions->permissions)), 403);

        return view('theme::subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequest $request)
    {
        abort_if(!in_array('subscription', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $data = $request->validated();

            Subscription::create($data);

            return redirect()->route('subscriptions.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('subscriptions.index')->with('error', 'Something went wrong!!');

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
    public function edit(Subscription $subscription)
    {
        abort_if(!in_array('subscription', json_decode(auth()->user()->permissions->permissions)), 403);

        return view('theme::subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        abort_if(!in_array('subscription', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $data = $request->validated();

            $subscription->update($data);

            return redirect()->route('subscriptions.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('subscriptions.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        abort_if(!in_array('subscription', json_decode(auth()->user()->permissions->permissions)), 403);

        try {

            $subscription->delete();

            return redirect()->route('subscriptions.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('subscriptions.index')->with('error', 'Something went wrong!!');

        }
    }
    public function mail()
    {

        return view('theme::subscription.sendmail');
    }

    public function sendMail(Request $request)
    {

        $this->validate($request, [
            'message' => 'required|string',
            'subject' => 'required|string',
            'subscriptions' => 'required',
            'subscriptions.*' => 'email',
        ]);
        foreach ($request->subscriptions as $to) {

            Theme::sendMail($to, 'theme::mail.mail', $request->subject, $request->message);

        }

        return redirect()->route('subscriptions.index')->with('success', 'Mail send process is in queue');

    }
}
