<?php

namespace Modules\TrainerVideo\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Trainer\Entities\Trainer;
use Modules\Trainer\Entities\TrainerImage;
use Modules\TrainerVideo\Http\Requests\TrainerVideoRequest;

class TrainerVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $trainersVideos=TrainerImage::get();
        return view('trainervideo::index',compact('trainersVideos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $trainers=Trainer::all();
        return view('trainervideo::create',compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TrainerVideoRequest $request)
    {
        $data=$request->validated();
        $trainerVideo= TrainerImage::create($data);
        if($trainerVideo->save()) {
            Toastr::success('Your Trainer Video has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('trainer.images.index');
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
        return view('trainervideo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $trainers=Trainer::all();
        $trainerVideo= TrainerImage::findOrFail($id);
        return view('trainervideo::edit',compact('trainers','trainerVideo'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(TrainerVideoRequest $request, $id)
    {
        $trainerVideo= TrainerImage::findOrFail($id);
        $data = $request->validated();
        $trainerVideo->update($data);
        Toastr::success('Your Trainer Video has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('trainer.images.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $trainerVideo= TrainerImage::findOrFail($id);
        $trainerVideo->delete();
        Toastr::success('Your Trainer Video has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $trainerVideo= TrainerImage::findOrFail($request->id);
        $trainerVideo->status = $request->status;
        if($trainerVideo->save()){
            return 1;
        }
        return 0;
    }
}
