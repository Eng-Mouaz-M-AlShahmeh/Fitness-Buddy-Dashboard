<?php

namespace Modules\Plan\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Plan\Entities\Plan;
use Modules\Plan\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $plans=Plan::get();
        return view('plan::index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('plan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PlanRequest $request)
    {
        $data = $request->validated();

        $plans = Plan::create($data);

        if($plans->save()) {
            Toastr::success('Your Plan has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('plan.index');
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
        return view('plan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $plan=Plan::findOrFail($id);
        return view('plan::edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PlanRequest $request, $id)
    {
        $plan=Plan::findOrFail($id);
        $data = $request->validated();
        $plan->update($data);
        Toastr::success('Your Plan has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('plan.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $plan=Plan::findOrFail($id);
        $plan->delete();
        Toastr::success('Your Plan has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $plan=Plan::findOrFail($request->id);
        $plan->status = $request->status;
        if($plan->save()){
            return 1;
        }
        return 0;
    }
}
