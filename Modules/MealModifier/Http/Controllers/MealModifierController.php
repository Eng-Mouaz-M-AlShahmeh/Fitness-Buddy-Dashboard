<?php

namespace Modules\MealModifier\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Meal\Entities\Meal;
use Modules\MealModifier\Entities\MealModifier;
use Modules\MealModifier\Http\Requests\MealModifierRequest;
use Modules\Modifier\Entities\Modifier;

class MealModifierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $mealModifiers=MealModifier::get();
        return view('mealmodifier::index',compact('mealModifiers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $meals=Meal::all();
        $modifiers=Modifier::all();
        return view('mealmodifier::create',compact('meals','modifiers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(MealModifierRequest $request)
    {
        $data = $request->validated();
        $mealModifier = MealModifier::create($data);
        if($mealModifier->save()) {
            Toastr::success('Your Meal Modifier has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('meal.modifier.index');
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
        return view('mealmodifier::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $meals=Meal::all();
        $modifiers=Modifier::all();
        $mealModifier =MealModifier::findOrFail($id);
        $getmeal=MealModifier::where('id',$mealModifier->id)->pluck('meal_id');
        $meal=Meal::whereIn('id',$getmeal)->select('id')->first();
        
        return view('mealmodifier::edit',compact('mealModifier','modifiers','meals','meal'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(MealModifierRequest $request, $id)
    {
        
        $mealModifier=MealModifier::findOrFail($id);
        $getmeal=MealModifier::where('id',$mealModifier->id)->pluck('meal_id');
        $meal=Meal::whereIn('id',$getmeal)->select('id')->first();
        //$tab='#tab_1';
        
        $data = $request->validated();
        $mealModifier->update($data);
        Toastr::success('Your Meal Modifier has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('resturant.meal.info',compact('meal'));
        
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $mealModifier=MealModifier::findOrFail($id);
        $mealModifier->delete();
        Toastr::success('Your Meal Modifier has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
