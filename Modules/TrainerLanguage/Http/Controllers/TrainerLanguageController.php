<?php

namespace Modules\TrainerLanguage\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Nutritionist\Entities\Language;
use Modules\Trainer\Entities\Trainer;
use Modules\Trainer\Entities\TrainerLanguage;
use Modules\TrainerLanguage\Http\Requests\TrainerLanguageRequest;

class TrainerLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $trainersLanguages=TrainerLanguage::get();
        return view('trainerlanguage::index',compact('trainersLanguages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $languages=Language::all();
        $trainers=Trainer::all();
        return view('trainerlanguage::create',compact('languages','trainers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TrainerLanguageRequest $request)
    {
        $data = $request->validated();

        $trainerLang = TrainerLanguage::create($data);

        if($trainerLang->save()) {
            Toastr::success('Your Trainer Language has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('trainer.language.index');
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
        return view('trainerlanguage::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $trainerLang =TrainerLanguage::findOrFail($id);
        $languages=Language::all();
        $trainers=Trainer::all();
        return view('trainerlanguage::edit',compact('trainerLang','languages','trainers'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(TrainerLanguageRequest $request, $id)
    {
        $trainerLang =TrainerLanguage::findOrFail($id);
        $data = $request->validated();
        $trainerLang->update($data);
        Toastr::success('Your Trainer Language has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('trainer.language.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $trainerLang =TrainerLanguage::findOrFail($id);
        $trainerLang->delete();
        Toastr::success('Your Trainer Language has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
