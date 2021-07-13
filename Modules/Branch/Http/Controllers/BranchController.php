<?php

namespace Modules\Branch\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Http\Requests\BranchRequest;
use Modules\Resturant\Entities\Resturant;
use Modules\ResturantSlider\Entities\ResturantSlider;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $branches=Branch::orderBy('created_at')->get();
        return view('branch::index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $rests=Resturant::all();
        return view('branch::create',compact('rests'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(BranchRequest $request)
    {
        $data=$request->validated();
        $branch= Branch::create($data);
        if($branch->save()) {
            Toastr::success('Your Branch has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('branch.index');
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
        return view('branch::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $rests=Resturant::all();
        $branch=Branch::findOrFail($id);
        return view('branch::edit',compact('rests','branch'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(BranchRequest $request, $id)
    {
        $branch=Branch::findOrFail($id);
        $data = $request->validated();
        $branch->update($data);
        Toastr::success('Your Branch has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        $getresturant=Branch::where('id',$branch->id)->pluck('resturant_id');
        $resturant=Resturant::whereIn('id',$getresturant)->select('id')->first();
        return redirect()->route('resturant.info',compact('resturant'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $branch=Branch::findOrFail($id);
        $branch->delete();
        Toastr::success('Your Branch has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $branch=Branch::findOrFail($request->id);
        $branch->status = $request->status;
        if($branch->save()){
            return 1;
        }
        return 0;
    }
}
