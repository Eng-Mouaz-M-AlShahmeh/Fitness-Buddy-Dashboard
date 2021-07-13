<?php

namespace Modules\NutritionistClass\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Nutritionist\Entities\Classes;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Nutritionist\Entities\NutritionistClass;
use Modules\NutritionistClass\Http\Requests\NutritionistClassRequest;

class NutritionistClassController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nutriClasses=NutritionistClass::get();
        return view('nutritionistclass::index',compact('nutriClasses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $nutritionists=Nutritionist::all();
        $classes=Classes::all();
        return view('nutritionistclass::create',compact('nutritionists','classes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(NutritionistClassRequest $request)
    {
        $data = $request->validated();

        $nutriClass = NutritionistClass::create($data);

        if($nutriClass->save()) {
            Toastr::success('Your Nutritionist Class has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('nutritionist.class.index');
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
        return view('nutritionistclass::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $nutritionists=Nutritionist::all();
        $classes=Classes::all();
        $nutriClass =NutritionistClass::findOrFail($id);
        return view('nutritionistclass::edit',compact('nutritionists','classes','nutriClass'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(NutritionistClassRequest $request, $id)
    {
        $nutriClass =NutritionistClass::findOrFail($id);
        $data = $request->validated();
        $nutriClass->update($data);
        Toastr::success('Your Nutritionist Class has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('nutritionist.class.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $nutriClass =NutritionistClass::findOrFail($id);
        $nutriClass->delete();
        Toastr::success('Your Nutritionist Class has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
