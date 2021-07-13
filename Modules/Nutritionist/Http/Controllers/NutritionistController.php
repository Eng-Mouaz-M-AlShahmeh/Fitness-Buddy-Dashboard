<?php

namespace Modules\Nutritionist\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\City\Entities\City;
use Modules\Department\Entities\DepartmentPlan;
use Modules\Nutritionist\Entities\Nationality;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Nutritionist\Entities\NutritionistRate;
use Modules\Nutritionist\Http\Requests\NutritionistRequest;
use Modules\Plan\Entities\Plan;

class NutritionistController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nutritionists=Nutritionist::orderBy('created_at')->get();
        return view('nutritionist::index',compact('nutritionists'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $getdetPlans=DepartmentPlan::where('dept_id','3')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        $cities=City::all();
        $nationalities=Nationality::all();
        return view('nutritionist::create',compact('plans','cities','nationalities'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(NutritionistRequest $request)
    {
        $data=$request->validated();
        $nutritionist=Nutritionist::create($data);
        if(isset($request->image)){
            $nutritionist->image=$request->image;
        }
        if($nutritionist->save()) {
            Toastr::success('Your Nutritionist has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('nutritionist.index');
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
        $nutritionist=Nutritionist::findOrFail($id);
        $rates=NutritionistRate::where('nutritionist_id',$nutritionist->id)->get();
        return view('nutritionist::show',compact('nutritionist','rates'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $nutritionist=Nutritionist::findOrFail($id);
        $getdetPlans=DepartmentPlan::where('dept_id','3')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        $cities=City::all();
        $nationalities=Nationality::all();
        return view('nutritionist::edit',compact('nutritionist','plans','cities','nationalities'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(NutritionistRequest $request, $id)
    {
        $nutritionist=Nutritionist::findOrFail($id);
        $data = $request->validated();
        if(isset($request->image)){
            $nutritionist->image=$request->image;
        }
        $nutritionist->update($data);
        Toastr::success('Your Nutritionist has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('nutritionist.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $nutritionist=Nutritionist::findOrFail($id);
        $nutritionist->delete();
        Toastr::success('Your Nutritionist has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $nutritionist=Nutritionist::findOrFail($request->id);
        $nutritionist->status = $request->status;
        if($nutritionist->save()){
            return 1;
        }
        return 0;
    }
}
