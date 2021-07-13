<?php

namespace Modules\NutritionistSlider\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\NutritionistSlider\Entities\NutritionistSlider;
use Modules\NutritionistSlider\Http\Requests\NutritionistSliderRequest;
use Modules\ResturantSlider\Entities\ResturantSlider;

class NutritionistSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nutritionistsSliders=NutritionistSlider::get();
        return view('nutritionistslider::index',compact('nutritionistsSliders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $nutritionists=Nutritionist::all();
        return view('nutritionistslider::create',compact('nutritionists'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(NutritionistSliderRequest $request)
    {
        $data=$request->validated();
        $nutritionistSlider= NutritionistSlider::create($data);
        if($nutritionistSlider->save()) {
            Toastr::success('Your Nutritionist Slider has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('nutritionist.sliders.index');
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
        return view('nutritionistslider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $nutritionists=Nutritionist::all();
        $nutritionistSlider= NutritionistSlider::findOrFail($id);
        return view('nutritionistslider::edit',compact('nutritionistSlider','nutritionists'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(NutritionistSliderRequest $request, $id)
    {
        $nutritionistSlider= NutritionistSlider::findOrFail($id);
        $data = $request->validated();
        $nutritionistSlider->update($data);
        Toastr::success('Your Nutritionist Slider has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('nutritionist.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $nutritionistSlider= NutritionistSlider::findOrFail($id);
        $nutritionistSlider->delete();
        Toastr::success('Your Nutritionist Slider has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $nutritionistSlider= NutritionistSlider::findOrFail($request->id);
        $nutritionistSlider->status = $request->status;
        if($nutritionistSlider->save()){
            return 1;
        }
        return 0;
    }
}
