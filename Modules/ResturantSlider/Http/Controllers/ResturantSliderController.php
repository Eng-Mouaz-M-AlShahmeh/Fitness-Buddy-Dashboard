<?php

namespace Modules\ResturantSlider\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Resturant\Entities\Resturant;
use Modules\ResturantSlider\Entities\ResturantSlider;
use Modules\ResturantSlider\Http\Requests\ResturantSliderRequest;

class ResturantSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $resturantsSliders=ResturantSlider::get();
        return view('resturantslider::index',compact('resturantsSliders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $resturants=Resturant::all();
        return view('resturantslider::create',compact('resturants'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ResturantSliderRequest $request)
    {
        $data=$request->validated();
        $resturantSlider= ResturantSlider::create($data);
        if($resturantSlider->save()) {
            Toastr::success('Your Resturant Slider has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('resturant.sliders.index');
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
        return view('resturantslider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $resturantSlider= ResturantSlider::findOrFail($id);
        $resturants=Resturant::all();
        return view('resturantslider::edit',compact('resturantSlider','resturants'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ResturantSliderRequest $request, $id)
    {
        $resturantSlider= ResturantSlider::findOrFail($id);
        $getresturant=ResturantSlider::where('id',$resturantSlider->id)->pluck('resturant_id');
        $resturant=Resturant::whereIn('id',$getresturant)->select('id')->first();
        $data = $request->validated();
        $resturantSlider->update($data);
        Toastr::success('Your Resturant Slider has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('resturant.info',compact('resturant'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $resturantSlider= ResturantSlider::findOrFail($id);
        $resturantSlider->delete();
        Toastr::success('Your Resturant Slider has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $resturantSlider= ResturantSlider::findOrFail($request->id);
        $resturantSlider->status = $request->status;
        if($resturantSlider->save()){
            return 1;
        }
        return 0;
    }
}
