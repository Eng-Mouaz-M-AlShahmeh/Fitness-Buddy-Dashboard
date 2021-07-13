<?php

namespace Modules\Subscription\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Http\Requests\SubscriptionsRequest;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $subscriptions=Subscription::get();
        return view('subscription::index',compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('subscription::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SubscriptionsRequest $request)
    {
        $data = $request->validated();
        $subscriptions = Subscription::create($data);
        if($subscriptions->save()) {
            Toastr::success('Your Subscription has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('subscriptions.index');
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('subscription::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscription::edit',compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(SubscriptionsRequest $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $data = $request->validated();
        $subscription->update($data);
        Toastr::success('Your Subscription has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('subscriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
        Toastr::success('Your Subscription has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }


    public function updateStatus(Request $request)
    {
        $subscription = Subscription::findOrFail($request->id);
        $subscription->status = $request->status;
        if($subscription->save()){
            return 1;
        }
        return 0;
    }
}
