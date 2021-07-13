<?php

namespace Modules\ClubSubscription\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ClubSubscription\Http\Requests\ClubSubscriptionRequest;
use Modules\FitnessClub\Entities\ClubSubscription;
use Modules\FitnessClub\Entities\FitnessClub;
use Modules\Subscription\Entities\Subscription;

class ClubSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $clubsSubs=ClubSubscription::get();
        return view('clubsubscription::index',compact('clubsSubs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $clubs=FitnessClub::all();
        $subscriptions=Subscription::all();
        return view('clubsubscription::create',compact('clubs','subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ClubSubscriptionRequest $request)
    {
        $data = $request->validated();

        $clubSub = ClubSubscription::create($data);

        if($clubSub->save()) {
            Toastr::success('Your Club Subscription has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('clubsubscription.index');
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
        return view('clubsubscription::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $clubs=FitnessClub::all();
        $subscriptions=Subscription::all();
        $clubSub =ClubSubscription::findOrFail($id);
        return view('clubsubscription::edit',compact('clubs','subscriptions','clubSub'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ClubSubscriptionRequest $request, $id)
    {
        $clubSub =ClubSubscription::findOrFail($id);
        $data = $request->validated();
        $clubSub->update($data);
        Toastr::success('Your Club Subscription has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('clubsubscription.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $clubSub =ClubSubscription::findOrFail($id);
        $clubSub->delete();
        Toastr::success('Your Club Subscription has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
