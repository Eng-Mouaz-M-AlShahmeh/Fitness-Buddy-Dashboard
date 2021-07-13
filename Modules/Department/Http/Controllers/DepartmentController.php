<?php

namespace Modules\Department\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Department\Entities\Department;
use Modules\Department\Http\Requests\DepartmentsRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $departments = Department::get();
        return view('department::index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('department::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DepartmentsRequest $request)
    {
        $data = $request->validated();
        $departments = Department::create($data);
        if(isset($request->image)){
            $departments->image=$request->image;
        }
        if($departments->save()) {
            Toastr::success('Your Department has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('departments.index');
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
        return view('department::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $department=Department::findOrFail($id);
        return view('department::edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(DepartmentsRequest $request, $id)
    {
        $department=Department::findOrFail($id);
        $data = $request->validated();
        if(isset($request->image)){
            $department->image=$request->image;
        }
        $department->update($data);
        Toastr::success('Your Department has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $department=Department::findOrFail($id);
        $department->delete();
        Toastr::success('Your Department has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $department=Department::findOrFail($request->id);
        $department->status = $request->status;
        if($department->save()){
            return 1;
        }
        return 0;
    }
}
