<?php

namespace Modules\ClubSlider\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ClubSlider\Http\Requests\ClubSliderRequest;
use Modules\FitnessClub\Entities\ClubSlider;
use Modules\FitnessClub\Entities\FitnessClub;

class ClubSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sliders=ClubSlider::get();
        return view('clubslider::index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $clubs=FitnessClub::all();
        return view('clubslider::create',compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ClubSliderRequest $request)
    {
        $data=$request->validated();
        $club=ClubSlider::create($data);
        if($club->save()) {
            Toastr::success('Your Club Slider has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('club.sliders.index');
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
        return view('clubslider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $clubSlider=ClubSlider::findOrFail($id);
        $clubs=FitnessClub::all();
        return view('clubslider::edit',compact('clubSlider','clubs'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ClubSliderRequest $request, $id)
    {
        $clubSlider=ClubSlider::findOrFail($id);
        $data = $request->validated();
        $clubSlider->update($data);
        Toastr::success('Your Club Slider has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('club.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $club=ClubSlider::findOrFail($id);
        $club->delete();
        Toastr::success('Your Club Slider has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $club= ClubSlider::findOrFail($request->id);
        $club->status = $request->status;
        if($club->save()){
            return 1;
        }
        return 0;
    }
}
