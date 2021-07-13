<?php

namespace Modules\TrainerClass\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Nutritionist\Entities\Classes;
use Modules\Nutritionist\Entities\NutritionistClass;
use Modules\Trainer\Entities\Trainer;
use Modules\Trainer\Entities\TrainerClass;
use Modules\TrainerClass\Http\Requests\TrainerClassRequest;

class TrainerClassController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $trainersClasses=TrainerClass::get();
        return view('trainerclass::index',compact('trainersClasses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $classes=Classes::all();
        $trainers=Trainer::all();
        return view('trainerclass::create',compact('classes','trainers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TrainerClassRequest $request)
    {
        $data = $request->validated();

        $trainerClass = TrainerClass::create($data);

        if($trainerClass->save()) {
            Toastr::success('Your Trainer Class has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('trainer.class.index');
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
        return view('trainerclass::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $trainerClass =TrainerClass::findOrFail($id);
        $classes=Classes::all();
        $trainers=Trainer::all();
        return view('trainerclass::edit',compact('trainerClass','classes','trainers'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(TrainerClassRequest $request, $id)
    {
        $trainerClass =TrainerClass::findOrFail($id);
        $data = $request->validated();
        $trainerClass->update($data);
        Toastr::success('Your Trainer Class has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('trainer.class.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $trainerClass =TrainerClass::findOrFail($id);
        $trainerClass->delete();
        Toastr::success('Your Trainer Class has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
