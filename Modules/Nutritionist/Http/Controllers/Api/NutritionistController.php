<?php

namespace Modules\Nutritionist\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\City\Entities\City;
use Modules\DepartmentSlider\Entities\DepartmentSlider;
use Modules\Nutritionist\Entities\Classes;
use Modules\Nutritionist\Entities\Language;
use Modules\Nutritionist\Entities\Nationality;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Nutritionist\Entities\NutritionistClass;
use Modules\Nutritionist\Entities\NutritionistImage;
use Modules\Nutritionist\Entities\NutritionistLanguage;
use Modules\Nutritionist\Entities\NutritionistRate;
use Modules\Nutritionist\Entities\NutritionistVideo;
use Modules\NutritionistSlider\Entities\NutritionistSlider;

class NutritionistController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function nutritionists(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('plan_id'=>'required','dept_id'=>'required','type'=>'required','lat'=>'required',
                'lng'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        $getNutritionistSliders=DepartmentSlider::where('status','1')
            ->where('dept_id','3')
            ->take('4')->get();
        $slider_item = [];
        $slider_list = [];
        foreach ($getNutritionistSliders as $slider) {
            $slider_item['id'] = $slider->id;
            $slider_item['image'] = $slider->slider;
            $slider_item['title'] = $slider->translate($lang)->title;
            $slider_item['description'] = $slider->translate($lang)->desc;
            $slider_list[] = $slider_item;
        }
        $data['nutritionist_sliders']=$slider_list;

        $getNutritionists=Nutritionist::where('dept_id',$request->dept_id)->
        where('plan_id',$request->plan_id)
        ->where('type',$request->type)
        ->where('status','1')
        ->where('is_busy','0')
        ->get();
        $res_item = [];
        $res_list = [];
        foreach ($getNutritionists as $nutritionist) {
            $res_item['id'] = $nutritionist->id;
            $getRestCity=City::where('id',$nutritionist->city_id)->first();
            $res_item['name'] = $nutritionist->translate($lang)->name;
            $res_item['city']=$getRestCity->translate($lang)->name;
            $res_item['image'] = $nutritionist->image;
            $res_item['price'] = $nutritionist->price.$nutritionist->translate($lang)->currency;
            $countClasses=NutritionistClass::where('nutritionist_id',$nutritionist->id)->count();
            $res_item['classes_count']=$nutritionist->translate($lang)->class;
            if ($nutritionist->type=="0"){
                $res_item['type'] = "male";
            }else{
                $res_item['type'] = "female";
            }
            $rateRest = NutritionistRate::where('nutritionist_id',$nutritionist->id)->select('rate')->avg('rate');
            if (!empty($rateRest)) {
                $res_item['rate'] = $rateRest;
            } else {
                $res_item['rate'] = 0;
            }
            $theta = $request->lng - $nutritionist->lng;
            $dist = sin(deg2rad($request->lat)) * sin(deg2rad($nutritionist->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($nutritionist->lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit='K';
            $unit = strtoupper($unit);

            if ($unit == "K")
            {
                // $res_item['distance'] = round(($miles * 1.609344),2);
                $res_item['distance'] =number_format((float)$miles* 1.609344, 2, '.', '')." km for distance";
            }
            else if ($unit == "N")
            {
                // $res_item['distance'] = round(($miles * 0.8684),2);
                $res_item['distance'] =  number_format((float)$miles* 0.8684, 2, '.', '')." km for distance";
            }
            else
            {
                // $res_item['distance'] =  round(($miles),2);
                $res_item['distance'] =  number_format((float)$miles, 2, '.', '')." km for distance";
            }
            $res_list[] = $res_item;
        }



        $data['nutritionists_list']=$res_list;

        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'allnutritionist',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function nutritionistDetails(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('nutritionist_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        $getNutritionistDetails=Nutritionist::where('id',$request->nutritionist_id)->get();
        $res_item = [];
        $res_list = [];
        foreach ($getNutritionistDetails as $nutritionist) {
            $res_item['id'] = $nutritionist->id;
            $getRestCity=City::where('id',$nutritionist->city_id)->first();
            $res_item['city'] =  $getRestCity->translate($lang)->name;
            $res_item['name'] = $nutritionist->translate($lang)->name;
            $res_item['image'] = $nutritionist->image;
            $res_item['about'] = $nutritionist->translate($lang)->about;
            $res_item['dob'] = $nutritionist->dob;
            $res_item['level'] = $nutritionist->translate($lang)->level;
            $res_item['available_time'] = $nutritionist->available_time;
           // $getnationality=NutritionistLanguage::where('nutritionist_id',$nutritionist->id)->pluck('language_id');
            $nationality=Nationality::where('id',$nutritionist->nationality_id)->first();
            $res_item['nationality'] = $nationality->translate($lang)->name;

            $getclasses=NutritionistClass::where('nutritionist_id',$nutritionist->id)->pluck('class_id');
            $class=Classes::where('id',$getclasses)->first();
            $res_item['class_time'] = $class->time;

            $getlang=NutritionistLanguage::where('nutritionist_id',$nutritionist->id)->pluck('language_id');
            $languages=Language::whereIn('id',$getlang)->get();
            $alllanguages = array();
            $i = 0;
            foreach ($languages as $language) {
                $alllanguages[$i] = array(
                    'id'=>$language->id,
                    'language'=> $language->translate($lang)->name,
                );
                $i++;
            }
            $res_item['languages'] = $alllanguages;
//            $res_item['languages'] = $class;
            $res_list = $res_item;
        }
        $data=$res_list;

        $nutritionistVideos = NutritionistImage::where('nutritionist_id', $request->nutritionist_id)
            ->where('status','1')->get();
        $res_video_item = [];
        $res_video_list = [];
        foreach ($nutritionistVideos as $video) {
            $res_video_item['id'] = $video->id;
            $res_video_item['name'] = $video->translate($lang)->name;
            $res_video_item['video'] = $video->image;
            $res_video_list[] = $res_video_item;
        }
        $data['nutritionist_videos']=$res_video_list;

        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'nutritionist_details',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function searchNutritionists(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('name'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }

        $getNutritionists=Nutritionist::where('name', 'LIKE', '%' . $request->name . '%')
            ->where('status','1')
            ->where('is_busy','0')
            ->get();
        $res_item = [];
        $res_list = [];
        foreach ($getNutritionists as $nutritionist) {
            $res_item['id'] = $nutritionist->id;
            $getRestCity=City::where('id',$nutritionist->city_id)->select('name')->first();
            $res_item['name'] = $nutritionist->name;
            $res_item['city']=$getRestCity->name;
            $res_item['image'] = $nutritionist->image;
            $res_item['price'] = $nutritionist->price;
            $countClasses=NutritionistClass::where('nutritionist_id',$nutritionist->id)->count();
            $res_item['classes_count']=$countClasses;

            $rateRest = round(NutritionistRate::where('nutritionist_id',$nutritionist->id)->select('rate')->avg('rate'));
            if (!empty($rateRest)) {
                $res_item['rate'] = (string)$rateRest;
            } else {
                $res_item['rate'] = "0";
            }
            $res_list[] = $res_item;
        }

        $data['nutritionists']=$res_list;


        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'nutritionists_results',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('nutritionist::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('nutritionist::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
