<?php

namespace Modules\Trainer\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\City\Entities\City;
use Modules\Department\Entities\Department;
use Modules\Department\Entities\DepartmentPlan;
use Modules\Nutritionist\Entities\Nationality;
use Modules\Plan\Entities\Plan;
use Modules\Resturant\Entities\Resturant;
use Modules\Resturant\Http\Requests\ResturantRequest;
use Modules\Trainer\Entities\Trainer;
use Modules\Trainer\Entities\TrainerRate;
use Modules\Trainer\Http\Requests\TrainerRequest;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $trainers=Trainer::orderBy('created_at')->get();
        return view('trainer::index',compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cities=City::all();
        $nationalities=Nationality::all();
        $getdetPlans=DepartmentPlan::where('dept_id','4')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        return view('trainer::create',compact('cities','plans','nationalities'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TrainerRequest $request)
    {
        $data=$request->validated();
        $trainer= Trainer::create($data);
        if(isset($request->image)){
            $trainer->image=$request->image;
        }
        if($trainer->save()) {
            Toastr::success('Your Trainer has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('trainer.index');
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
        $trainer=Trainer::findOrFail($id);
        $rates=TrainerRate::where('trainer_id',$trainer->id)->get();
        return view('trainer::show',compact('trainer','rates'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $trainer=Trainer::findOrFail($id);
        $cities=City::all();
        $nationalities=Nationality::all();
        $getdetPlans=DepartmentPlan::where('dept_id','4')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        return view('trainer::edit',compact('trainer','cities','nationalities','plans'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(TrainerRequest $request, $id)
    {
        $trainer=Trainer::findOrFail($id);
        $data = $request->validated();
        if(isset($request->image)){
            $trainer->image=$request->image;
        }
        $trainer->update($data);
        Toastr::success('Your Trainer has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('trainer.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $trainer=Trainer::findOrFail($id);
        $trainer->delete();
        Toastr::success('Your Trainer has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $trainer=Trainer::findOrFail($request->id);
        $trainer->status = $request->status;
        if($trainer->save()){
            return 1;
        }
        return 0;
    }
}
