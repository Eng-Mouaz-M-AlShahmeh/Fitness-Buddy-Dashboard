<?php

namespace Modules\DepartmentSlider\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\DepartmentSlider\Entities\DepartmentSlider;
use Modules\DepartmentSlider\Http\Requests\DepartmentSliderRequest;

class DepartmentSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $deptsSliders=DepartmentSlider::get();
        return view('departmentslider::index',compact('deptsSliders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $depts=Department::all();
        return view('departmentslider::create',compact('depts'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DepartmentSliderRequest $request)
    {
        $data = $request->validated();

        $deptSlider = DepartmentSlider::create($data);

        if($deptSlider->save()) {
            Toastr::success('Your Department slider has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('dept.slider.index');
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
        return view('departmentslider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $deptSlider =DepartmentSlider::findOrFail($id);
        $depts=Department::all();
        return view('departmentslider::edit',compact('depts','deptSlider'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(DepartmentSliderRequest $request, $id)
    {
        $deptSlider=DepartmentSlider::findOrFail($id);
        $data = $request->validated();
        $deptSlider->update($data);
        Toastr::success('Your Department slider has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('dept.slider.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $deptSlider=DepartmentSlider::findOrFail($id);
        $deptSlider->delete();
        Toastr::success('Your Department slider has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $deptSlider=DepartmentSlider::findOrFail($request->id);
        $deptSlider->status = $request->status;
        if($deptSlider->save()){
            return 1;
        }
        return 0;
    }
}
