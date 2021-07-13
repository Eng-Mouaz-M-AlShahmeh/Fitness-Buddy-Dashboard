<?php

namespace Modules\ResturantCategory\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Resturant\Entities\MealDay;
use Modules\Resturant\Entities\Resturant;
use Modules\ResturantCategory\Entities\ResturantCategory;
use Modules\ResturantCategory\Http\Requests\ResturantCategoryRequest;

class ResturantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $restCats=ResturantCategory::orderBy('created_at')->get();
        return view('resturantcategory::index',compact('restCats'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $rests=Resturant::all();
        $mealsdays=MealDay::all();
        return view('resturantcategory::create',compact('rests','mealsdays'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ResturantCategoryRequest $request)
    {
        $data = $request->validated();
        $restCats = ResturantCategory::create($data);
        if(isset($request->meal_day_id)){
            $restCats->meal_day_id=$request->meal_day_id;
        }
        if($restCats->save()) {
            Toastr::success('Your Resturant Category has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.categories.index');
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
        return view('resturantcategory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $restCats= ResturantCategory::findOrFail($id);
        $rests=Resturant::all();
        $mealsdays=MealDay::all();
        return view('resturantcategory::edit',compact('restCats','rests','mealsdays'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ResturantCategoryRequest $request, $id)
    {
        $restCats= ResturantCategory::findOrFail($id);
        $data = $request->validated();
        if(isset($request->meal_day_id)){
            $restCats->meal_day_id=$request->meal_day_id;
        }
        $restCats->update($data);
        Toastr::success('Your Resturant Category has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        $getresturant=ResturantCategory::where('id',$restCats->id)->pluck('resturant_id');
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
        $restCats= ResturantCategory::findOrFail($id);
        $restCats->delete();
        Toastr::success('Your Resturant Category has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $restCats= ResturantCategory::findOrFail($request->id);
        $restCats->status = $request->status;
        if($restCats->save()){
            return 1;
        }
        return 0;
    }
}
