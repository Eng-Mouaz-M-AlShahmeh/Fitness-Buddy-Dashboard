<?php

namespace Modules\Meal\Http\Controllers;

use App\Models\Day;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Branch\Entities\Branch;
use Modules\Department\Entities\DepartmentPlan;
use Modules\Meal\Entities\Meal;
use Modules\Meal\Http\Requests\MealRequest;
use Modules\Plan\Entities\Plan;
use Modules\Resturant\Entities\MealDay;
use Modules\Resturant\Entities\Resturant;
use Modules\ResturantCategory\Entities\ResturantCategory;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $meals=Meal::orderBy('created_at')->get();
        return view('meal::index',compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $mealsdays=MealDay::all();
        $resturants=Resturant::all();
        $cats=ResturantCategory::all();
        $days=Day::all();
        $plans=Plan::all();
        $branches=Branch::all();
        return view('meal::create',compact('resturants','cats',
            'mealsdays','days',
            'plans','branches'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(MealRequest $request)
    {
        $data = $request->validated();
        if(isset($request->meal_day_id)){
            $data['meal_day_id']=$request->meal_day_id;
        }
        if(isset($request->day_id)){
            $data['day_id']=$request->day_id;
        }
        if(isset($request->plan_id)){
            $data['plan_id']=$request->plan_id;
        }
        $meal = Meal::create($data);
        if($meal->save()) {
            Toastr::success('Your Meal has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('meals.index');
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
        return view('meal::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $meal = Meal::findOrFail($id);
        $resturants=Resturant::all();
        $mealsdays=MealDay::all();
        $cats=ResturantCategory::where('resturant_id',$meal->resturant_id)->get();
        $days=Day::all();
        $getdetPlans=DepartmentPlan::where('dept_id','1')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        $branches=Branch::all();
        $getresid=Resturant::where('id',$meal->resturant_id)->first();
        return view('meal::edit',compact('meal','resturants',
            'cats','mealsdays',
            'days','plans','branches','getresid'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(MealRequest $request, $id)
    {
        $meal = Meal::findOrFail($id);
        $data = $request->validated();
        if(isset($request->meal_day_id)){
            $meal->meal_day_id=$request->meal_day_id;
        }
        if(isset($request->day_id)){
            $meal->day_id=$request->day_id;
        }
        if(isset($request->plan_id)){
            $meal->plan_id=$request->plan_id;
        }
        $data['resturant_id']=$meal->resturant_id;
        $meal->update($data);
        Toastr::success('Your Meal has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        $getresturant=Meal::where('id',$meal->id)->pluck('resturant_id');
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
        $meal = Meal::findOrFail($id);
        $meal->delete();
        Toastr::success('Your Meal has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $meal = Meal::findOrFail($request->id);
        $meal->status = $request->status;
        if($meal->save()){
            return 1;
        }
        return 0;
    }

      public function getResturantCats($resturant_id)
    {
      $cats=ResturantCategory::get();
        $rests_cats = ResturantCategory::where('resturant_id',$resturant_id)->get();
          $res_item = [];
        $resturant_cats = [];
        foreach($rests_cats as $cat){
            $res_item['id'] = $cat->id;
             $res_item['name'] = $cat->translate('en')->name;
              $resturant_cats[] = $res_item;
        }
        return response()->json($resturant_cats);
    }
}
