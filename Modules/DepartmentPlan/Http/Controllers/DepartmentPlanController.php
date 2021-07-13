<?php

namespace Modules\DepartmentPlan\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\Department\Entities\DepartmentPlan;
use Modules\DepartmentPlan\Http\Requests\DepartmentPlanRequest;
use Modules\Plan\Entities\Plan;

class DepartmentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $deptsPlans=DepartmentPlan::get();
        return view('departmentplan::index',compact('deptsPlans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $departments=Department::all();
        $plans=Plan::all();
        return view('departmentplan::create',compact('departments','plans'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DepartmentPlanRequest $request)
    {
        $data = $request->validated();

        $deptsPlans = DepartmentPlan::create($data);

        if($deptsPlans->save()) {
            Toastr::success('Your Department plan has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('dept.plan.index');
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
        return view('departmentplan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $departments=Department::all();
        $plans=Plan::all();
        $deptPlan =DepartmentPlan::findOrFail($id);
        return view('departmentplan::edit',compact('deptPlan','departments','plans'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(DepartmentPlanRequest $request, $id)
    {
        $deptPlan=DepartmentPlan::findOrFail($id);
        $data = $request->validated();
        $deptPlan->update($data);
        Toastr::success('Your Department plan has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('dept.plan.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $deptPlan=DepartmentPlan::findOrFail($id);
        $deptPlan->delete();
        Toastr::success('Your Department plan has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
