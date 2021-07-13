<?php

namespace Modules\Resturant\Http\Controllers;


use App\Models\Day;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Http\Requests\BranchRequest;
use Modules\City\Entities\City;
use Modules\Department\Entities\Department;
use Modules\Department\Entities\DepartmentPlan;
use Modules\Meal\Entities\Meal;
use Modules\Meal\Http\Requests\MealRequest;
use Modules\Plan\Entities\Plan;
use Modules\Resturant\Entities\MealDay;
use Modules\Resturant\Entities\Resturant;
use Modules\Resturant\Entities\ResturantRating;
use Modules\Resturant\Http\Requests\ResturantRequest;
use Modules\ResturantCategory\Entities\ResturantCategory;
use Modules\ResturantCategory\Http\Requests\ResturantCategoryRequest;
use Modules\ResturantSlider\Entities\ResturantSlider;
use Modules\ResturantSlider\Http\Requests\ResturantSliderRequest;

use Modules\MealIngredient\Entities\MealIngredient;
use Modules\MealIngredient\Http\Requests\MealIngredientRequest;
use Modules\MealModifier\Entities\MealModifier;
use Modules\MealModifier\Http\Requests\MealModifierRequest;
use Modules\Modifier\Entities\Modifier;



class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $resturants=Resturant::orderBy('created_at')->get();
        return view('resturant::index',compact('resturants'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cities=City::all();
        $departments=Department::all();
        $getdetPlans=DepartmentPlan::where('dept_id','1')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        return view('resturant::create',compact('cities','departments','plans'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ResturantRequest $request)
    {
        $data=$request->validated();
        $resturant= Resturant::create($data);
        if(isset($request->image)){
            $resturant->image=$request->image;
        }
        if(isset($request->icon)){
            $resturant->icon=$request->icon;
        }
        if(isset($request->min)){
            $resturant->min=$request->min;
        }
        if($resturant->save()) {
            Toastr::success('Your Resturant has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.index');
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
        $resturant=Resturant::findOrFail($id);
        $rates=ResturantRating::where('resturant_id',$resturant->id)->get();
        return view('resturant::show',compact('resturant','rates'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $cities=City::all();
        $departments=Department::all();
        $getdetPlans=DepartmentPlan::where('dept_id','1')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        $resturant=Resturant::findOrFail($id);
        return view('resturant::edit',compact('resturant','cities','departments','plans'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ResturantRequest $request, $id)
    {
        $resturant=Resturant::findOrFail($id);
        $data = $request->validated();
        
        /*
        if(isset($request->image)){
            $resturant->image=$request->image;
        }
        if(isset($request->icon)){
            $resturant->icon=$request->icon;
        }
        if(isset($request->min)){
            $resturant->min=$request->min;
        }
        */
        
        $resturant->update($data);
        Toastr::success('Your Resturant has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('resturant.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $resturant=Resturant::findOrFail($id);
        $resturant->delete();
        Toastr::success('Your Resturant has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $resturant=Resturant::findOrFail($request->id);
        $resturant->status = $request->status;
        if($resturant->save()){
            return 1;
        }
        return 0;
    }

    public function info($id)
    {
        $resturant=Resturant::findOrFail($id);
        $resturant_id=Resturant::findOrFail($id);
        $resturantId=Resturant::findOrFail($id);
        $resturantid=Resturant::findOrFail($id);
        $sliders=ResturantSlider::where('resturant_id',$resturant->id)->get();
        $branches=Branch::where('resturant_id',$resturant->id)->get();
        $restCats=ResturantCategory::where('resturant_id',$resturant->id)->get();
        $meals=Meal::where('resturant_id',$resturant->id)->get();
        return view('resturant::info',compact(
            'resturant','sliders','branches','restCats',
                     'meals','resturant_id','resturantId','resturantid'
        ));
    }

    public function createResturantSlider($id)
    {
        $resturant=Resturant::findOrFail($id);
        return view('resturantslider::create',compact('resturant'));
    }
    public function storeResturantSlider(ResturantSliderRequest $request,$id)
    {
        $resturant=Resturant::findOrFail($id);
        $data=$request->validated();
        $resturantSlider= ResturantSlider::create($data);
        $resturantSlider->resturant_id=$resturant->id;
        if($resturantSlider->save()) {
            Toastr::success('Your Resturant Slider has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.info',compact('resturant'));
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
    public function createResturantBranch($id)
    {
        $resturant_id=Resturant::findOrFail($id);
        return view('branch::create',compact('resturant_id'));
    }
    public function storeResturantBranch(BranchRequest $request,$id)
    {
        $resturant_id=Resturant::findOrFail($id);
        $data=$request->validated();
        $branch= Branch::create($data);
        if($branch->save()) {
            Toastr::success('Your Branch has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.info',compact('resturant_id'));
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function createResturantCategory($id)
    {
        $resturantId=Resturant::findOrFail($id);
        $mealsdays=MealDay::all();
        return view('resturantcategory::create',compact('resturantId','mealsdays'));
    }

    public function storeResturantCategory(ResturantCategoryRequest $request,$id)
    {
        $resturantId=Resturant::findOrFail($id);
        $data = $request->validated();
        $restCats = ResturantCategory::create($data);
        if(isset($request->meal_day_id)){
            $restCats->meal_day_id=$request->meal_day_id;
        }
        if($restCats->save()) {
            Toastr::success('Your Resturant Category has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.info',compact('resturantId'));
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

    }
    
    
    /*************************************************************/
    /*************************************************************/
    
    // meal info section with three parts
     public function mealInfo($id)
    {
        //$rest_id=Meal::select('resturant_id')->where('id', '=',$id)->get();
        
        $meal=Meal::findOrFail($id);
        
        //$mealID=Meal::findOrFail($id);
        $meal_id=Meal::findOrFail($id);
        $mealid=Meal::findOrFail($id);
        
        $modifiers=Modifier::all();
        $mealModifiers=MealModifier::where('meal_id',$meal_id->id)->get();
        $mealIngredients=MealIngredient::where('meal_id',$mealid->id)->get();
        
        
        return view('resturant::meal_info',compact(
            'meal','modifiers','mealModifiers','mealIngredients','meal_id','mealid'
                     
        ));
        
        
    }
    
    /*************************************************************/ 
    
    public function createMealModifier($id)
    {

        $meal_id=Meal::findOrFail($id);
        $modifiers=Modifier::all();

        return view('mealmodifier::create',compact('meal_id','modifiers'));
    }
    public function storeMealModifier(MealModifierRequest $request,$id)
    {
        $meal_id=Meal::findOrFail($id);
        $data=$request->validated();
        $mealModifier= MealModifier::create($data);
        if($mealModifier->save()) {
            Toastr::success('Your Meal Modifier has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.meal.info',compact('meal_id'));
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }


    /*************************************************************/
    
    public function createMealIngredients($id)
    {
        $mealid=Meal::findOrFail($id);
        $mealIngredient=MealIngredient::all();

        return view('mealingredient::create',compact('mealid','mealIngredient'));
        
    }
    public function storeMealIngredients(MealIngredientRequest $request,$id)
    {
        $mealid=Meal::findOrFail($id);
        $data=$request->validated();
        $mealIngredient= MealIngredient::create($data);
        if($mealIngredient->save()) {
            Toastr::success('Your Meal Ingredient has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.meal.info',compact('mealid'));
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        
        
    }






/*************************************************************/
/*************************************************************/


    public function createMeal($id)
    {
        $mealsdays=MealDay::all();
        $resturantid=Resturant::findOrFail($id);
        $cats=ResturantCategory::where('resturant_id',$resturantid->id)->get();
        $days=Day::all();
        $getdetPlans=DepartmentPlan::where('dept_id','1')->pluck('plan_id');
        $plans=Plan::whereIn('id',$getdetPlans)->get();
        $branches=Branch::all();
        $resturants=Resturant::all();
        return view('meal::create',compact('resturantid','cats',
            'mealsdays','days',
            'plans','branches','resturants'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function storeMeal(MealRequest $request,$id)
    {
        $resturantid=Resturant::findOrFail($id);
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
        $data['resturant_id']=$resturantid->id;
        $meal = Meal::create($data);
        if($meal->save()) {
            Toastr::success('Your Meal has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.info',compact('resturantid'));
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }


}
