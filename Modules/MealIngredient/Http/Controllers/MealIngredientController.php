<?php

namespace Modules\MealIngredient\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Meal\Entities\Meal;
use Modules\MealIngredient\Entities\MealIngredient;
use Modules\MealIngredient\Http\Requests\MealIngredientRequest;

class MealIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $mealIngredients=MealIngredient::orderBy('created_at')->get();
        return view('mealingredient::index',compact('mealIngredients'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $meals=Meal::all();
        return view('mealingredient::create',compact('meals'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(MealIngredientRequest $request)
    {
        $data = $request->validated();
        $mealIngredient = MealIngredient::create($data);
        if($mealIngredient->save()) {
            Toastr::success('Your Meal Ingredient has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('meal.ingredient.index');
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
        return view('mealingredient::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $meals=Meal::all();
        $mealIngredient = MealIngredient::findOrFail($id);
        
        $getmeal=MealIngredient::where('id',$mealIngredient->id)->pluck('meal_id');
        $meal=Meal::whereIn('id',$getmeal)->select('id')->first();
        
        return view('mealingredient::edit',compact('mealIngredient','meals','meal'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(MealIngredientRequest $request, $id)
    {
        $mealIngredient = MealIngredient::findOrFail($id);
        
        $getmeal=MealIngredient::where('id',$mealIngredient->id)->pluck('meal_id');
        $meal=Meal::whereIn('id',$getmeal)->select('id')->first();
        
        
        $data = $request->validated();
        $mealIngredient->update($data);
        Toastr::success('Your Meal Ingredient has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('resturant.meal.info',compact('meal'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $mealIngredient = MealIngredient::findOrFail($id);
        $mealIngredient->delete();
        Toastr::success('Your Meal Ingredient has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
