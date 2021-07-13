<?php

namespace Modules\NutritionistLanguage\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Nutritionist\Entities\Language;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Nutritionist\Entities\NutritionistLanguage;
use Modules\NutritionistLanguage\Http\Requests\NutritionistLanguageRequest;

class NutritionistLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nutriLangs=NutritionistLanguage::get();
        return view('nutritionistlanguage::index',compact('nutriLangs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $nutritionists=Nutritionist::all();
        $languages=Language::all();
        return view('nutritionistlanguage::create',compact('nutritionists','languages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(NutritionistLanguageRequest $request)
    {
        $data = $request->validated();

        $nutriLang = NutritionistLanguage::create($data);

        if($nutriLang->save()) {
            Toastr::success('Your Nutritionist Language has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('nutritionist.language.index');
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
        return view('nutritionistlanguage::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $nutriLang =NutritionistLanguage::findOrFail($id);
        $nutritionists=Nutritionist::all();
        $languages=Language::all();
        return view('nutritionistlanguage::edit',compact('nutriLang','nutritionists','languages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(NutritionistLanguageRequest $request, $id)
    {
        $nutriLang =NutritionistLanguage::findOrFail($id);
        $data = $request->validated();
        $nutriLang->update($data);
        Toastr::success('Your Nutritionist Language has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('nutritionist.language.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $nutriLang =NutritionistLanguage::findOrFail($id);
        $nutriLang->delete();
        Toastr::success('Your Nutritionist Language has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
