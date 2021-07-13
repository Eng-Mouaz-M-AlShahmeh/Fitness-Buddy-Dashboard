<?php

namespace Modules\Modifier\Http\Controllers;

use App\Models\Day;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Modifier\Entities\Modifier;
use Modules\Modifier\Http\Requests\ModifierRequest;

use Modules\Branch\Entities\Branch;
use Modules\Department\Entities\DepartmentPlan;
use Modules\Meal\Entities\Meal;
use Modules\Meal\Http\Requests\MealRequest;
use Modules\Plan\Entities\Plan;
use Modules\Resturant\Entities\MealDay;
use Modules\Resturant\Entities\Resturant;
use Modules\ResturantCategory\Entities\ResturantCategory;


class ModifierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $modifiers=Modifier::orderBy('created_at')->get();
        return view('modifier::index',compact('modifiers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('modifier::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ModifierRequest $request)
    {
        $rest=Meal::first();
        
        $data = $request->validated();

        $modifier = Modifier::create($data);

        if($modifier->save()) {
            Toastr::success('Your Modifier has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.meal.info',$rest->id);
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
        return view('modifier::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $modifier= Modifier::findOrFail($id);
        return view('modifier::edit',compact('modifier'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ModifierRequest $request, $id)
    {
        $modifier=Modifier::findOrFail($id);
        
        $rest=Meal::first();
        
        $getmeal=Modifier::where('id',$modifier->id)->pluck('id');
        $meal=Meal::whereIn('id',$getmeal)->select('id')->first();
        
        $data = $request->validated();
        $modifier->update($data);
        Toastr::success('Your Modifier has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('resturant.meal.info',$rest->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $modifier= Modifier::findOrFail($id);
        $modifier->delete();
        Toastr::success('Your Modifier has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $modifier = Modifier::findOrFail($request->id);
        $modifier->status = $request->status;
        if($modifier->save()){
            return 1;
        }
        return 0;
    }
}
