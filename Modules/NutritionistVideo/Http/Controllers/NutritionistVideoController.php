<?php

namespace Modules\NutritionistVideo\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Nutritionist\Entities\NutritionistImage;
use Modules\Nutritionist\Entities\NutritionistVideo;
use Modules\NutritionistVideo\Http\Requests\NutritionistVideoRequest;

class NutritionistVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nutritionistsVideos=NutritionistImage::get();
        return view('nutritionistvideo::index',compact('nutritionistsVideos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $nutritionists=Nutritionist::all();
        return view('nutritionistvideo::create',compact('nutritionists'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(NutritionistVideoRequest $request)
    {
        $data=$request->validated();
        $nutritionistVideo= NutritionistImage::create($data);
        if($nutritionistVideo->save()) {
            Toastr::success('Your Nutritionist Video has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('nutritionist.videos.index');
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
        return view('nutritionistvideo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $nutritionists=Nutritionist::all();
        $nutritionistVideo= NutritionistImage::findOrFail($id);
        return view('nutritionistvideo::edit',compact('nutritionists','nutritionistVideo'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(NutritionistVideoRequest $request, $id)
    {
        $nutritionistVideo= NutritionistImage::findOrFail($id);
        $data = $request->validated();
        $nutritionistVideo->update($data);
        Toastr::success('Your Nutritionist Video has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('nutritionist.videos.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $nutritionistVideo= NutritionistImage::findOrFail($id);
        $nutritionistVideo->delete();
        Toastr::success('Your Nutritionist Video has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $nutritionistVideo= NutritionistImage::findOrFail($request->id);
        $nutritionistVideo->status = $request->status;
        if($nutritionistVideo->save()){
            return 1;
        }
        return 0;
    }
}
