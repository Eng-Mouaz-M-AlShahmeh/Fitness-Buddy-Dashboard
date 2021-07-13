<?php

namespace Modules\MealDay\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\MealDay\Http\Requests\MealDayRequest;
use Modules\Resturant\Entities\MealDay;

class MealDayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $meals=MealDay::orderBy('created_at')->get();
        return view('mealday::index',compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('mealday::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(MealDayRequest $request)
    {
        $data = $request->validated();
        $meal = MealDay::create($data);
        if($meal->save()) {
            Toastr::success('Your Meal Day has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('mealday.index');
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
        return view('mealday::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $meal = MealDay::findOrFail($id);
        return view('mealday::edit',compact('meal'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(MealDayRequest $request, $id)
    {
        $meal = MealDay::findOrFail($id);
        $data = $request->validated();
        $meal->update($data);
        Toastr::success('Your Meal Day has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('mealday.index');
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $meal = MealDay::findOrFail($id);
        $meal->delete();
        Toastr::success('Your Meal Day has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
