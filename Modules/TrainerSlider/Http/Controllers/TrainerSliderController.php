<?php

namespace Modules\TrainerSlider\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Trainer\Entities\Trainer;
use Modules\Trainer\Entities\TrainerSlider;
use Modules\TrainerSlider\Http\Requests\TrainerSliderRequest;

class TrainerSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $trainersSliders=TrainerSlider::get();
        return view('trainerslider::index',compact('trainersSliders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $trainers=Trainer::all();
        return view('trainerslider::create',compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TrainerSliderRequest $request)
    {
        $data=$request->validated();
        $trainerSlider= TrainerSlider::create($data);
        if($trainerSlider->save()) {
            Toastr::success('Your Trainer Slider has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('trainer.sliders.index');
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
        return view('trainerslider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $trainerSlider= TrainerSlider::findOrFail($id);
        $trainers=Trainer::all();
        return view('trainerslider::edit',compact('trainers','trainerSlider'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(TrainerSliderRequest $request, $id)
    {
        $trainerSlider= TrainerSlider::findOrFail($id);
        $data = $request->validated();
        $trainerSlider->update($data);
        Toastr::success('Your Trainer Slider has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('trainer.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $trainerSlider= TrainerSlider::findOrFail($id);
        $trainerSlider->delete();
        Toastr::success('Your Trainer Slider has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $trainerSlider= TrainerSlider::findOrFail($request->id);
        $trainerSlider->status = $request->status;
        if($trainerSlider->save()){
            return 1;
        }
        return 0;
    }
}
